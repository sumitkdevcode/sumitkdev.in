<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'views',
        'reading_time',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'sub_images',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'sub_images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blogPost) {
            if (empty($blogPost->slug)) {
                $blogPost->slug = \Illuminate\Support\Str::slug($blogPost->title);
            }

            // Calculate reading time (average 200 words per minute)
            if ($blogPost->content) {
                $wordCount = str_word_count(strip_tags($blogPost->content));
                $blogPost->reading_time = ceil($wordCount / 200);
            }
        });

        static::updating(function ($blogPost) {
            if ($blogPost->isDirty('content')) {
                $wordCount = str_word_count(strip_tags($blogPost->content));
                $blogPost->reading_time = ceil($wordCount / 200);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the full URL for the featured image.
     * Handles both local storage paths and external URLs.
     */
    public function getImageUrl(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's already a full URL, return as-is
        if (str_starts_with($this->featured_image, 'http://') || str_starts_with($this->featured_image, 'https://')) {
            return $this->featured_image;
        }

        // Otherwise, it's a local storage path
        return asset('storage/' . $this->featured_image);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
