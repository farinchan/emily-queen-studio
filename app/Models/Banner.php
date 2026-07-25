<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function getImageAttribute()
    {
        $image = $this->attributes['image'] ?? null;

        if (!$image) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        return asset('storage/banners/' . $image);
    }
}
