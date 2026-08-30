<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AhpPlayer extends Model
{
    protected $table = 'ahp_players';

    protected $fillable = [
        'no_reg', 'name', 'date_of_birth', 'position', 'photo', 'og_image', 'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active'     => 'boolean',
    ];

    public function results(): HasMany
    {
        return $this->hasMany(AhpTestResult::class, 'player_id');
    }

    public function getAgeAttribute(): int
    {
        return $this->date_of_birth ? $this->date_of_birth->age : 0;
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            // New disk: public/uploads/ahp-players/...
            $directPath = public_path('uploads/' . $this->photo);
            if (file_exists($directPath)) {
                return asset('uploads/' . $this->photo);
            }
            // Fallback: old symlink storage/app/public -> public/storage
            return asset('storage/' . $this->photo);
        }
        // Default silhouette image
        return asset('storage/default-player.png');
    }

    public function getOgImageUrlAttribute(): ?string
    {
        if ($this->og_image) {
            $directPath = public_path('uploads/' . $this->og_image);
            if (file_exists($directPath)) {
                return asset('uploads/' . $this->og_image);
            }
            return asset('storage/' . $this->og_image);
        }
        return null;
    }

    public function latestResult()
    {
        return $this->results()->with('session')->latest('id')->first();
    }
}
