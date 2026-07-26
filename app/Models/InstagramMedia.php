<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstagramMedia extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'children' => 'array',
            'raw_payload' => 'array',
            'is_visible' => 'boolean',
            'posted_at' => 'datetime',
            'synced_at' => 'datetime',
        ];
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(InstagramAccount::class, 'instagram_account_id');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function getPreviewUrlAttribute(): ?string
    {
        if ($this->media_type === 'VIDEO' || $this->media_product_type === 'REELS') {
            return $this->thumbnail_url ?: $this->media_url;
        }

        return $this->media_url ?: $this->thumbnail_url;
    }
}
