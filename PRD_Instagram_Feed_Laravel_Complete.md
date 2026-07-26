# PRD — Laravel Instagram Feed Integration

**Status:** Ready for AI implementation  
**Scope:** One Instagram account, feed only  
**Target framework:** Laravel 12+  
**Database:** MySQL  
**UI:** Blade + Tailwind CSS  
**Integration:** Official Instagram API with Instagram Login  

---

## 1. AI Implementation Instruction

Implement this document as a complete Laravel feature.

The implementation must:

1. Use the official Instagram API.
2. Support exactly one connected Instagram Professional account.
3. Store the Instagram account and encrypted access token in MySQL.
4. Never require the administrator to manually place an access token in `.env`.
5. Support Instagram image posts, videos, reels, and carousel posts.
6. Synchronise feed data into a local database.
7. Display the stored feed publicly without calling Instagram on every page request.
8. Automatically refresh the Instagram access token.
9. Automatically synchronise posts using Laravel Scheduler.
10. Include migrations, models, services, controllers, commands, requests, routes, Blade views, policies/middleware assumptions, logging, error handling, and tests.

Do not implement Instagram Direct Messages, comments, insights, content publishing, story publishing, or multiple accounts.

---

## 2. Product Overview

Build an Instagram Feed module for a Laravel website.

An authenticated administrator can connect one Instagram Business or Creator account through Instagram OAuth. After successful authentication, Laravel exchanges the authorisation code for an access token, converts it to a long-lived token, retrieves the account profile, and stores the account in the database.

The application periodically retrieves media owned by the connected account and stores it locally. Public visitors view the locally stored feed, reducing dependency on Instagram API availability and avoiding API calls on every page load.

---

## 3. Goals

- Provide a simple “Connect Instagram” workflow.
- Support one Instagram Professional account.
- Save account details and encrypted access token to MySQL.
- Retrieve all available feed pages through cursor pagination.
- Store Instagram posts locally using idempotent synchronisation.
- Display a responsive public Instagram feed.
- Support image, video, reel, and carousel media.
- Refresh long-lived tokens before expiration.
- Provide clear connection, synchronisation, and error status to administrators.
- Avoid third-party Instagram Laravel wrapper packages.

---

## 4. Non-Goals

The first version must not implement:

- Instagram Direct Messages
- Inbox or chatbot features
- Comments or replies
- Likes
- Instagram Insights
- Publishing posts
- Publishing reels or stories
- Hashtag search
- Fetching another account’s media
- Personal Instagram accounts
- Multiple connected accounts
- Scraping Instagram HTML
- Username/password storage

---

## 5. User Roles

### Administrator

Can:

- View Instagram integration status.
- Connect an Instagram account.
- Reconnect or replace the account.
- Disconnect the account.
- Trigger a manual feed synchronisation.
- View last successful synchronisation.
- View token expiration.
- View the imported posts.

### Public Visitor

Can:

- View published Instagram feed items.
- Open the original post on Instagram.
- Browse feed pagination or “load more”.

Public visitors must never receive access-token data.

---

## 6. Assumptions

- The Laravel application already has administrator authentication.
- The connected Instagram account is a Professional account: Business or Creator.
- Production uses HTTPS.
- `APP_KEY` is configured and must remain stable.
- Laravel Scheduler is configured on the server.
- A queue may be used, but the base implementation must also work with the database queue driver.
- The application displays only media owned by the connected account.

---

## 7. Environment Configuration

Add only static Meta application credentials to `.env`:

```env
INSTAGRAM_APP_ID=
INSTAGRAM_APP_SECRET=
INSTAGRAM_REDIRECT_URI=https://example.com/instagram/callback
INSTAGRAM_GRAPH_BASE_URL=https://graph.instagram.com
INSTAGRAM_OAUTH_BASE_URL=https://api.instagram.com
INSTAGRAM_SYNC_LIMIT=100
INSTAGRAM_SYNC_ENABLED=true
```

Do not store these values in `.env`:

- Instagram access token
- Instagram user ID
- Username
- Token expiration
- Synchronisation cursor

Add this configuration to `config/services.php`:

```php
'instagram' => [
    'app_id' => env('INSTAGRAM_APP_ID'),
    'app_secret' => env('INSTAGRAM_APP_SECRET'),
    'redirect_uri' => env('INSTAGRAM_REDIRECT_URI'),
    'graph_base_url' => env(
        'INSTAGRAM_GRAPH_BASE_URL',
        'https://graph.instagram.com'
    ),
    'oauth_base_url' => env(
        'INSTAGRAM_OAUTH_BASE_URL',
        'https://api.instagram.com'
    ),
    'sync_limit' => (int) env('INSTAGRAM_SYNC_LIMIT', 100),
    'sync_enabled' => (bool) env('INSTAGRAM_SYNC_ENABLED', true),
],
```

---

## 8. Database Design

### 8.1 Table: `instagram_accounts`

Only one active row may exist.

Columns:

| Column | Type | Rules |
|---|---|---|
| id | BIGINT | Primary key |
| instagram_user_id | VARCHAR(100) | Unique |
| username | VARCHAR(255) | Nullable |
| name | VARCHAR(255) | Nullable |
| account_type | VARCHAR(50) | Nullable |
| profile_picture_url | TEXT | Nullable |
| media_count | UNSIGNED INTEGER | Nullable |
| access_token | LONGTEXT | Encrypted Eloquent cast |
| token_expires_at | TIMESTAMP | Nullable |
| connected_at | TIMESTAMP | Nullable |
| last_synced_at | TIMESTAMP | Nullable |
| last_sync_status | VARCHAR(30) | Default `never` |
| last_sync_error | TEXT | Nullable |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

Allowed `last_sync_status` values:

- `never`
- `running`
- `success`
- `failed`

Single-account rule:

- Before saving a newly authorised account, delete or replace the existing row inside a transaction.
- Application logic must always retrieve the account using `InstagramAccount::query()->first()`.

### 8.2 Table: `instagram_media`

Columns:

| Column | Type | Rules |
|---|---|---|
| id | BIGINT | Primary key |
| instagram_account_id | BIGINT | Foreign key, cascade delete |
| instagram_media_id | VARCHAR(100) | Unique |
| caption | LONGTEXT | Nullable |
| media_type | VARCHAR(30) | Required |
| media_product_type | VARCHAR(30) | Nullable |
| media_url | TEXT | Nullable |
| thumbnail_url | TEXT | Nullable |
| permalink | TEXT | Required |
| username | VARCHAR(255) | Nullable |
| posted_at | TIMESTAMP | Required |
| children | JSON | Nullable |
| raw_payload | JSON | Nullable |
| is_visible | BOOLEAN | Default true |
| synced_at | TIMESTAMP | Nullable |
| created_at | TIMESTAMP | |
| updated_at | TIMESTAMP | |

Supported `media_type` values:

- `IMAGE`
- `VIDEO`
- `CAROUSEL_ALBUM`

Possible `media_product_type` values may include:

- `FEED`
- `REELS`
- other values returned by the API

Do not define a restrictive database enum for external API values. Use strings so future API values do not break synchronisation.

Indexes:

- Unique index on `instagram_media_id`
- Index on `posted_at`
- Index on `is_visible`
- Composite index on `instagram_account_id`, `posted_at`

### 8.3 Optional Table: `instagram_sync_logs`

Recommended for production observability.

Columns:

- id
- instagram_account_id
- started_at
- completed_at
- status
- fetched_count
- inserted_count
- updated_count
- error_message
- metadata JSON
- timestamps

---

## 9. Eloquent Models

### 9.1 `InstagramAccount`

File:

```text
app/Models/InstagramAccount.php
```

Requirements:

- Define fillable attributes.
- Cast `access_token` as `encrypted`.
- Cast timestamps as `datetime`.
- Define `media()` as `hasMany`.
- Add helper methods:
  - `isConnected(): bool`
  - `isTokenExpired(): bool`
  - `tokenExpiresSoon(int $days = 7): bool`

Do not expose `access_token` through model serialization.

Use:

```php
protected $hidden = [
    'access_token',
];
```

### 9.2 `InstagramMedia`

File:

```text
app/Models/InstagramMedia.php
```

Requirements:

- Define fillable attributes.
- Cast `children` and `raw_payload` as arrays.
- Cast `is_visible` as boolean.
- Cast `posted_at` and `synced_at` as datetime.
- Define `account()` as `belongsTo`.
- Add query scope:

```php
scopeVisible($query)
```

- Add accessor or helper method returning the best preview URL:
  - For video/reel: prefer `thumbnail_url`
  - Otherwise: use `media_url`

---

## 10. Application Structure

```text
app/
├── Console/
│   └── Commands/
│       ├── RefreshInstagramToken.php
│       └── SyncInstagramFeed.php
├── Exceptions/
│   └── InstagramApiException.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── InstagramController.php
│   │   └── InstagramFeedController.php
│   └── Requests/
│       └── InstagramCallbackRequest.php
├── Jobs/
│   └── SyncInstagramFeedJob.php
├── Models/
│   ├── InstagramAccount.php
│   └── InstagramMedia.php
├── Services/
│   ├── InstagramAuthService.php
│   ├── InstagramApiService.php
│   └── InstagramSyncService.php
└── Support/
    └── InstagramMediaMapper.php

resources/views/
├── admin/instagram/index.blade.php
└── instagram/feed.blade.php

routes/
├── web.php
└── console.php
```

---

## 11. OAuth Flow

### 11.1 Connect

1. Administrator visits Instagram settings.
2. Administrator clicks “Connect Instagram”.
3. Laravel creates a cryptographically secure OAuth state.
4. State is saved in the session.
5. Administrator is redirected to Instagram OAuth.
6. Administrator grants permission.
7. Instagram redirects to the configured callback.
8. Laravel validates the callback state.
9. Laravel exchanges the code for a short-lived token.
10. Laravel exchanges it for a long-lived token.
11. Laravel retrieves the Instagram profile.
12. Laravel stores the account and encrypted token in a transaction.
13. Laravel dispatches initial feed synchronisation.
14. Administrator returns to the settings page.

Required scope:

```text
instagram_business_basic
```

### 11.2 OAuth State Rules

- Use a random value of at least 40 characters.
- Store it in the session before redirecting.
- Require exact comparison using `hash_equals`.
- Remove it from session after a successful or failed callback.
- Reject missing or invalid state with HTTP 403.

### 11.3 Account Replacement

Because the system supports one account:

- Reconnecting the same Instagram ID updates the existing record.
- Connecting a different Instagram ID replaces the old account.
- Replacing the account must also delete old locally stored media through cascade delete.
- Perform replacement in a database transaction.

---

## 12. Service Specifications

### 12.1 `InstagramAuthService`

Responsibilities:

- Build authorisation URL.
- Exchange code for short-lived token.
- Exchange short-lived token for long-lived token.
- Refresh long-lived token.

Required methods:

```php
public function authorizationUrl(string $state): string;

public function exchangeCode(string $code): array;

public function exchangeLongLivedToken(string $shortToken): array;

public function refreshLongLivedToken(string $token): array;
```

### 12.2 `InstagramApiService`

Responsibilities:

- Retrieve profile.
- Retrieve paginated media.
- Handle network errors and API errors.
- Never log access tokens.

Required methods:

```php
public function getProfile(string $token): array;

public function getMediaPage(
    string $token,
    int $limit = 100,
    ?string $after = null
): array;
```

Media fields:

```text
id,
caption,
media_type,
media_product_type,
media_url,
thumbnail_url,
permalink,
timestamp,
username,
children{id,media_type,media_url,thumbnail_url,permalink,timestamp}
```

HTTP client requirements:

- `acceptJson()`
- connect timeout: 10 seconds
- total timeout: 30 seconds
- retry transient failures two times
- do not retry invalid OAuth or permission errors
- throw `InstagramApiException` containing:
  - safe message
  - HTTP status
  - Meta error code when available
  - Meta error subcode when available

### 12.3 `InstagramSyncService`

Responsibilities:

- Fetch all required media pages.
- Map API payload to database fields.
- Upsert media using `instagram_media_id`.
- Preserve local `is_visible` value during updates.
- Record synchronisation status.
- Avoid duplicate posts.
- Update account’s profile metadata and `last_synced_at`.

Required method:

```php
public function sync(
    InstagramAccount $account,
    bool $fullSync = false
): InstagramSyncResult;
```

Default incremental behaviour:

- Fetch newest pages first.
- Stop when a page contains only media already stored and no newer changes are expected.
- A full sync continues until no next cursor exists.
- Initial connection must run a full sync.
- Scheduled sync may use incremental mode.

Use a lock to prevent overlapping synchronisations:

```php
Cache::lock('instagram-feed-sync', 300)
```

---

## 13. Synchronisation Rules

For every API media item:

1. Validate required keys:
   - `id`
   - `media_type`
   - `permalink`
   - `timestamp`
2. Convert timestamp to UTC-compatible Carbon value.
3. Store the original API media ID as a string.
4. Save carousel children as JSON.
5. Save raw payload only when enabled by application policy.
6. Upsert using `instagram_media_id`.
7. Do not reset `is_visible` during updates.
8. Set `synced_at` to current time.

Deletion behaviour:

- Do not immediately delete a local record simply because it is absent from one incremental response.
- During a full sync, records not seen may be marked stale or hidden only if explicitly required.
- Default implementation must keep previously imported records.

---

## 14. Artisan Commands

### 14.1 Refresh Token

Command:

```bash
php artisan instagram:refresh-token
```

Behaviour:

- Exit successfully when no account exists.
- Skip refresh if expiration is not near unless `--force` is provided.
- Refresh when token expires in 10 days or fewer.
- Update encrypted token and expiration.
- Never print token value.
- Return non-zero exit code on failure.

Signature:

```text
instagram:refresh-token {--force}
```

### 14.2 Synchronise Feed

Command:

```bash
php artisan instagram:sync
```

Options:

```text
instagram:sync {--full} {--queue}
```

Behaviour:

- `--full`: fetch every available page.
- `--queue`: dispatch `SyncInstagramFeedJob`.
- Without `--queue`: run synchronously.
- Show counts for fetched, inserted, and updated records.
- Never show the access token.

---

## 15. Queue Job

File:

```text
app/Jobs/SyncInstagramFeedJob.php
```

Requirements:

- Implements `ShouldQueue`.
- Uses a unique job strategy or cache lock.
- Maximum attempts: 3.
- Backoff: 60, 180, 600 seconds.
- Stores only account ID in the job payload, not the access token.
- Reloads the account from the database during execution.
- Logs safe structured context.
- Marks account sync status as failed after final failure.

---

## 16. Scheduler

Add to `routes/console.php`:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('instagram:refresh-token')
    ->dailyAt('02:00')
    ->withoutOverlapping();

Schedule::command('instagram:sync --queue')
    ->hourly()
    ->withoutOverlapping();
```

Server cron:

```cron
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

The exact scheduled times may be changed through project conventions.

---

## 17. Routes

Admin routes require authentication and administrator authorisation.

```php
Route::middleware(['auth', 'can:manage-instagram'])
    ->prefix('admin/instagram')
    ->name('admin.instagram.')
    ->group(function () {
        Route::get('/', [InstagramController::class, 'index'])
            ->name('index');

        Route::get('/connect', [InstagramController::class, 'redirect'])
            ->name('connect');

        Route::post('/sync', [InstagramController::class, 'sync'])
            ->name('sync');

        Route::delete('/disconnect', [InstagramController::class, 'disconnect'])
            ->name('disconnect');
    });
```

Callback:

```php
Route::get(
    '/instagram/callback',
    [InstagramController::class, 'callback']
)->name('instagram.callback');
```

Public feed:

```php
Route::get(
    '/instagram-feed',
    InstagramFeedController::class
)->name('instagram.feed');
```

Callback must be protected by state validation, not by public trust alone. It may remain within an authenticated browser session so only an administrator can complete connection.

---

## 18. Controller Requirements

### 18.1 Admin `InstagramController`

Methods:

```php
index()
redirect()
callback(InstagramCallbackRequest $request)
sync()
disconnect()
```

`index()`:

- Retrieve the single account.
- Show post count.
- Show token expiration.
- Show last sync status and error.
- Show last synchronisation time.

`redirect()`:

- Generate OAuth state.
- Store state in session.
- Redirect away to Instagram.

`callback()`:

- Handle user cancellation.
- Validate state and code.
- Exchange tokens.
- Retrieve profile.
- Save account transactionally.
- Dispatch initial full sync.
- Redirect with success/error flash message.

`sync()`:

- Dispatch synchronisation job.
- Return immediately with success message.
- Prevent duplicate queued syncs.

`disconnect()`:

- Delete the account.
- Cascade-delete local media.
- Clear relevant cache.
- Do not attempt to revoke Instagram permission unless separately implemented.

### 18.2 `InstagramFeedController`

Requirements:

- Read only local `instagram_media`.
- Never call Instagram API during public requests.
- Filter `is_visible = true`.
- Order by `posted_at DESC`.
- Paginate with 12 or 24 items.
- Cache the first page for a short duration.
- Return Blade view.

---

## 19. Admin UI Specification

Page title:

```text
Instagram Integration
```

Disconnected state:

- Explanation that a Business or Creator account is required.
- “Connect Instagram” button.
- No token field.

Connected state displays:

- Profile image
- Display name
- `@username`
- Account type
- Instagram media count
- Imported media count
- Connected date
- Token expiration
- Last synchronisation
- Sync status
- Last sync error, when present

Actions:

- View public feed
- Synchronise now
- Reconnect
- Disconnect

UX rules:

- Confirm before disconnecting.
- Disable sync button while status is `running`.
- Do not render any access token.
- Show friendly status badges.
- Use POST/DELETE forms with CSRF protection.

---

## 20. Public Feed UI Specification

Responsive layout:

- 2 columns on small screens
- 3 columns on medium screens
- 4 columns on large screens

Each card displays:

- Best available preview image
- Optional caption excerpt
- Media-type badge
- Instagram publication date
- Link to original Instagram post

Media rendering:

- Image: show `media_url`
- Video/reel: show `thumbnail_url`, falling back to `media_url`
- Carousel: show cover media and carousel badge
- Broken media: show a neutral placeholder

Accessibility:

- Use meaningful alternative text.
- External links use `target="_blank"` and `rel="noopener noreferrer"`.
- Buttons and links must be keyboard accessible.
- Do not rely on colour alone for status.

Performance:

- Lazy-load images.
- Public feed uses local database only.
- Use pagination.
- Cache the first page.
- Avoid downloading Instagram media to local storage in version 1.

---

## 21. Caching

Recommended cache keys:

```text
instagram:account
instagram:feed:page:{page}
instagram:feed:count
```

Invalidate feed cache after:

- Successful sync
- Media visibility change
- Account disconnect
- Account replacement

Do not cache decrypted access tokens longer than required.

---

## 22. Logging and Observability

Log events:

- OAuth started
- OAuth completed
- Account connected
- Account replaced
- Token refreshed
- Sync started
- Sync completed
- Sync failed
- Account disconnected

Never log:

- Access token
- App secret
- Full OAuth callback URL containing code
- Sensitive request headers

Structured safe context may include:

- Local account ID
- Instagram user ID
- Synchronisation count
- Error code
- HTTP status
- Duration

---

## 23. Error Handling

Handle at minimum:

- Administrator cancels OAuth
- Missing authorisation code
- Invalid OAuth state
- Invalid redirect URI
- Invalid app credentials
- Invalid or expired access token
- Revoked permission
- Unsupported personal account
- Instagram API rate limit
- Network timeout
- Malformed API payload
- Database failure
- Duplicate sync
- Token decryption failure caused by changed `APP_KEY`

User-facing messages must be concise and safe. Detailed errors belong in logs without credentials.

---

## 24. Security Requirements

- Store access token using Laravel encrypted Eloquent cast.
- Add `access_token` to `$hidden`.
- Do not expose it in Blade, JSON resources, logs, exceptions, or queue payloads.
- Validate OAuth state.
- Protect admin endpoints with authentication and authorisation.
- Use CSRF protection for POST and DELETE routes.
- Use HTTPS in production.
- Rate-limit manual sync requests.
- Keep `APP_KEY` stable and securely backed up.
- Never collect Instagram username or password.
- Use only official OAuth.
- Do not scrape Instagram.
- Validate all external API payloads before persistence.

---

## 25. Testing Requirements

### Unit Tests

Test:

- OAuth URL construction
- OAuth state generation and validation
- Media payload mapping
- Preview URL selection
- Token expiration helpers
- API exception mapping
- Incremental sync stop logic
- Full sync pagination
- Single-account replacement logic

### Feature Tests

Test:

- Guest cannot access admin Instagram page
- Non-authorised user cannot manage Instagram
- Admin can start OAuth
- Callback rejects invalid state
- Callback stores encrypted token
- Callback replaces an existing account
- Initial sync is dispatched
- Manual sync is dispatched
- Disconnect removes account and media
- Public feed reads local database
- Public feed does not invoke HTTP client
- Hidden media is not displayed
- Pagination works

### HTTP Fakes

Use `Http::fake()` for all Meta API calls.

Required scenarios:

- Successful token exchange
- Failed token exchange
- Successful profile retrieval
- Successful single-page feed
- Successful multi-page feed
- Rate-limited request
- Server error
- Timeout
- Missing media field
- Token refresh success and failure

### Command Tests

Test:

- Refresh skips when account is missing
- Refresh skips when token is not near expiration
- `--force` refreshes token
- Sync command invokes service
- Full sync option is passed correctly
- Failure returns non-zero exit code

---

## 26. Definition of Done

The implementation is complete when:

- Migrations run successfully on MySQL.
- Exactly one Instagram account can be connected.
- The token is encrypted in the database.
- No token is stored in `.env`.
- OAuth state is validated.
- Profile data is stored.
- Initial full feed synchronisation works.
- Scheduled incremental synchronisation works.
- Images, videos, reels, and carousels display correctly.
- Public feed performs no Instagram API call.
- Manual synchronisation is available to administrators.
- Token refresh is automated.
- Disconnect removes account and imported media.
- Errors are safely handled and logged.
- Automated tests pass.
- Code follows existing project conventions and Laravel coding standards.

---

## 27. Recommended AI Implementation Order

Implement in this order:

1. Add environment and service configuration.
2. Create account and media migrations.
3. Create Eloquent models and relationships.
4. Create custom Instagram API exception.
5. Implement authentication service.
6. Implement API service.
7. Implement media mapper.
8. Implement synchronisation service.
9. Implement queue job.
10. Implement Artisan commands.
11. Configure Scheduler.
12. Implement callback request validation.
13. Implement admin controller.
14. Implement public feed controller.
15. Register routes.
16. Build admin Blade page.
17. Build public feed Blade page.
18. Add caching.
19. Add logging.
20. Add unit and feature tests.
21. Run formatting, tests, and static analysis.
22. Document Meta Developer setup in the project README.

---

## 28. Required Final AI Output

When implementing this PRD, the AI must return:

- List of created and modified files
- Complete code, not pseudocode
- Required terminal commands
- Required `.env` keys
- Meta Developer configuration steps
- Migration instructions
- Scheduler and cron instructions
- Queue worker instructions
- Test commands
- Any assumptions made
- Any limitation caused by current Instagram API behaviour

Do not leave TODO placeholders for core functionality.
