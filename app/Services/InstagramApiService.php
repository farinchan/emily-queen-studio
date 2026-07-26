<?php

namespace App\Services;

use App\Exceptions\InstagramApiException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramApiService
{
    protected string $graphBaseUrl;

    public function __construct()
    {
        $config = config('services.instagram');
        $this->graphBaseUrl = (string) ($config['graph_base_url'] ?? 'https://graph.instagram.com');
    }

    public function getProfile(string $token): array
    {
        $response = Http::acceptJson()
            ->timeout(30)
            ->connectTimeout(10)
            ->retry(2, 200, null, false)
            ->get($this->graphBaseUrl.'/me', [
                'fields' => 'id,username,name,account_type,profile_picture_url,media_count',
                'access_token' => $token,
            ]);

        if ($response->failed()) {
            Log::error('Instagram getProfile failed', [
                'status' => $response->status(),
            ]);
            throw InstagramApiException::fromApiResponse($response->json() ?? [], $response->status());
        }

        return $response->json();
    }

    public function getMediaPage(string $token, int $limit = 100, ?string $after = null): array
    {
        $fields = 'id,caption,media_type,media_product_type,media_url,thumbnail_url,permalink,timestamp,username,children{id,media_type,media_url,thumbnail_url,permalink,timestamp}';

        $params = [
            'fields' => $fields,
            'limit' => $limit,
            'access_token' => $token,
        ];

        if ($after) {
            $params['after'] = $after;
        }

        $response = Http::acceptJson()
            ->timeout(30)
            ->connectTimeout(10)
            ->retry(2, 200, null, false)
            ->get($this->graphBaseUrl.'/me/media', $params);

        if ($response->failed()) {
            Log::error('Instagram getMediaPage failed', [
                'status' => $response->status(),
            ]);
            throw InstagramApiException::fromApiResponse($response->json() ?? [], $response->status());
        }

        return $response->json();
    }
}
