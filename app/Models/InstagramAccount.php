<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class InstagramAccount extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'access_token',
    ];

    protected function casts(): array
    {
        return [
            'access_token' => 'encrypted',
            'token_expires_at' => 'datetime',
            'connected_at' => 'datetime',
            'last_synced_at' => 'datetime',
            'media_count' => 'integer',
        ];
    }

    public function media(): HasMany
    {
        return $this->hasMany(InstagramMedia::class, 'instagram_account_id');
    }

    public function syncLogs(): HasMany
    {
        return $this->hasMany(InstagramSyncLog::class, 'instagram_account_id');
    }

    public function isConnected(): bool
    {
        return !empty($this->access_token);
    }

    public function isTokenExpired(): bool
    {
        return $this->token_expires_at !== null && $this->token_expires_at->isPast();
    }

    public function tokenExpiresSoon(int $days = 10): bool
    {
        if ($this->token_expires_at === null) {
            return false;
        }

        return Carbon::now()->addDays($days)->gte($this->token_expires_at);
    }
}
