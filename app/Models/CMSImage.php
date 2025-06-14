<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class CMSImage extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'image',
        'page',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'image'      => 'string',
        'page'       => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function booted(): void {
        static::saved(function ($cmsImage) {
            if ($cmsImage->page === 'home') {
                Cache::forget('home_banners');
            }
            if ($cmsImage->page === 'testimonial') {
                Cache::forget('testimonial_image');
            }
        });

        static::deleted(function ($cmsImage) {
            if ($cmsImage->page === 'home') {
                Cache::forget('home_banners');
            }
            if ($cmsImage->page === 'testimonial') {
                Cache::forget('testimonial_image');
            }
        });
    }
}
