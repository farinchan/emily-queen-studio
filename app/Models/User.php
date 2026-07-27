<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['image', 'name', 'email', 'password', 'about', 'instagram', 'order', 'position', 'is_show'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        $image = $this->image;

        if (!$image) {
            return 'https://res.cloudinary.com/dh0tzenpm/image/upload/v1785120553/place-user_z5vnnu.png';
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, 'users/')) {
            return asset('storage/' . $image);
        }

        return asset('storage/users/' . $image);
    }

    public function getInstagramHandleAttribute(): string
    {
        $insta = $this->instagram;

        if (!$insta) {
            return '@emilyqueenstudio';
        }

        if (str_starts_with($insta, 'http://') || str_starts_with($insta, 'https://')) {
            $path = trim((string) parse_url($insta, PHP_URL_PATH), '/');
            return $path ? '@' . $path : '@emilyqueenstudio';
        }

        return '@' . ltrim($insta, '@');
    }
}
