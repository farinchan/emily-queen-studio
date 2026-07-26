<?php

namespace App\Services;

use App\Exceptions\InstagramApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramAuthService
{
    protected string $appId;
    protected string $appSecret;
    protected string $redirectUri;
    protected string $graphBaseUrl;
    protected string $oauthBaseUrl;

    public function __construct()
    {
        $config = config('services.instagram');
        $this->appId = (string) ($config['app_id'] ?? '');
        $this->appSecret = (string) ($config['app_secret'] ?? '');
        $this->redirectUri = (string) ($config['redirect_uri'] ?? '');
        $this->graphBaseUrl = (string) ($config['graph_base_url'] ?? 'https://graph.instagram.com');
        $this->oauthBaseUrl = (string) ($config['oauth_base_url'] ?? 'https://api.instagram.com');
    }

    public function authorizationUrl(string $state): string
    {
        $params = http_build_query([
            'client_id' => $this->appId,
            'redirect_uri' => $this->redirectUri,
            'scope' => 'instagram_business_basic',
            'response_type' => 'code',
            'state' => $state,
        ]);

        return $this->oauthBaseUrl.'/oauth/authorize?'.$params;
    }

    public function exchangeCode(string $code): array
    {
        $response = Http::asForm()
            ->acceptJson()
            ->timeout(30)
            ->connectTimeout(10)
            ->retry(2, 200, null, false)
            ->post($this->oauthBaseUrl.'/oauth/access_token', [
                'client_id' => $this->appId,
                'client_secret' => $this->appSecret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'code' => $code,
            ]);

        if ($response->failed()) {
            Log::error('Instagram code exchange failed', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
            throw InstagramApiException::fromApiResponse($response->json() ?? [], $response->status());
        }

        return $response->json();
    }

    public function exchangeLongLivedToken(string $shortToken): array
    {
        $response = Http::acceptJson()
            ->timeout(30)
            ->connectTimeout(10)
            ->retry(2, 200, null, false)
            ->get($this->graphBaseUrl.'/access_token', [
                'grant_type' => 'ig_exchange_token',
                'client_secret' => $this->appSecret,
                'access_token' => $shortToken,
            ]);

        if ($response->failed()) {
            Log::error('Instagram long-lived token exchange failed', [
                'status' => $response->status(),
            ]);
            throw InstagramApiException::fromApiResponse($response->json() ?? [], $response->status());
        }

        return $response->json();
    }

    public function refreshLongLivedToken(string $token): array
    {
        $response = Http::acceptJson()
            ->timeout(30)
            ->connectTimeout(10)
            ->retry(2, 200, null, false)
            ->get($this->graphBaseUrl.'/refresh_access_token', [
                'grant_type' => 'ig_refresh_token',
                'access_token' => $token,
            ]);

        if ($response->failed()) {
            Log::error('Instagram token refresh failed', [
                'status' => $response->status(),
            ]);
            throw InstagramApiException::fromApiResponse($response->json() ?? [], $response->status());
        }

        return $response->json();
    }
}
