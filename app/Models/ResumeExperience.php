<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'start_date',
        'end_date',
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
            \Illuminate\Support\Facades\Cache::forget('resume_experiences');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('resume_experiences');
        });
    }
}