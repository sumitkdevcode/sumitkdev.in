<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'technologies',
        'bullets',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'bullets' => 'array',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('resume_projects');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('resume_projects');
        });
    }
}