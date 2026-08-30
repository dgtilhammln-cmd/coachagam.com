<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = ['key', 'group', 'value', 'type', 'label', 'description', 'is_public'];

    // ─── Static helpers ──────────────────────────────────────────────────

    /**
     * Ambil nilai setting berdasarkan key.
     * Gunakan: SiteSetting::get('homepage.hero_slides')
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) return $default;

        return match ($setting->type) {
            'json'    => json_decode($setting->value, true) ?? $default,
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            default   => $setting->value ?? $default,
        };
    }

    /**
     * Simpan nilai setting berdasarkan key.
     * Gunakan: SiteSetting::set('homepage.cta_heading', 'Judul Baru')
     */
    public static function set(string $key, mixed $value): void
    {
        $type = static::where('key', $key)->value('type') ?? 'text';

        if ($type === 'json' && is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

        $group = explode('.', $key)[0]; // e.g. 'homepage' from 'homepage.cta_bg_image'

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'updated_at' => now()]
        );
    }

    /**
     * Ambil semua setting dalam satu group sebagai key => value array.
     * Gunakan: SiteSetting::group('homepage')
     */
    public static function group(string $group): array
    {
        return static::where('group', $group)
            ->get()
            ->mapWithKeys(fn ($s) => [
                $s->key => match ($s->type) {
                    'json'    => json_decode($s->value, true),
                    'boolean' => filter_var($s->value, FILTER_VALIDATE_BOOLEAN),
                    default   => $s->value,
                }
            ])
            ->toArray();
    }
}
