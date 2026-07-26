<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class InstagramMediaMapper
{
    /**
     * Map Instagram Graph API media item to database format.
     */
    public static function map(array $item, int $accountId): array
    {
        $postedAt = isset($item['timestamp'])
            ? Carbon::parse($item['timestamp'])->utc()
            : Carbon::now()->utc();

        $children = null;
        if (isset($item['children']['data']) && is_array($item['children']['data'])) {
            $children = array_map(function ($child) {
                return [
                    'id' => $child['id'] ?? null,
                    'media_type' => $child['media_type'] ?? null,
                    'media_url' => $child['media_url'] ?? null,
                    'thumbnail_url' => $child['thumbnail_url'] ?? null,
                    'permalink' => $child['permalink'] ?? null,
                    'timestamp' => $child['timestamp'] ?? null,
                ];
            }, $item['children']['data']);
        }

        return [
            'instagram_account_id' => $accountId,
            'instagram_media_id' => (string) $item['id'],
            'caption' => $item['caption'] ?? null,
            'media_type' => $item['media_type'] ?? 'IMAGE',
            'media_product_type' => $item['media_product_type'] ?? 'FEED',
            'media_url' => $item['media_url'] ?? null,
            'thumbnail_url' => $item['thumbnail_url'] ?? null,
            'permalink' => $item['permalink'] ?? '',
            'username' => $item['username'] ?? null,
            'posted_at' => $postedAt,
            'children' => $children,
            'raw_payload' => $item,
            'synced_at' => Carbon::now()->utc(),
        ];
    }
}
