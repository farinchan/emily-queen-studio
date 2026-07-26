<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photography extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'keywords' => 'array',
        ];
    }

    public function getImageAttribute()
    {
        $image = $this->attributes['image'] ?? null;

        if (!$image) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, 'photographies/')) {
            return asset('storage/' . $image);
        }

        return asset('storage/photographies/' . $image);
    }
}
