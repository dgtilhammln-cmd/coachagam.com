<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category',
        'featured_image',
        'author_name',
        'author_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'faq',
        'read_time',
        'views',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured'  => 'boolean',
        'views'        => 'integer',
        'faq'          => 'array',
    ];

    // ─── Scopes ──────────────────────────────────────────────

    /** Hanya post yang sudah dipublikasikan */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /** Filter berdasarkan kategori */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    // ─── Accessors ───────────────────────────────────────────

    /** URL lengkap artikel */
    public function getUrlAttribute(): string
    {
        return url('/blog/' . $this->slug);
    }

    /** Estimasi waktu baca (jika tidak disimpan di DB) */
    public function getReadTimeTextAttribute(): string
    {
        if ($this->read_time) {
            return $this->read_time . ' min baca';
        }
        $wordCount = str_word_count(strip_tags((string) $this->body));
        $minutes   = max(1, (int) ceil($wordCount / 200));
        return $minutes . ' min baca';
    }

    // ─── Relationships ───────────────────────────────────────

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
