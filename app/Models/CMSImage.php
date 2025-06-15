<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
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

    /**
     * Get all "home" banners, cached for 1 hour.
     */
    public static function homeBanners(): Collection {
        return Cache::remember('home_banners', 3600, fn() =>
            static::where('page', 'home')
                ->where('status', 'active')
                ->get()
        );
    }

    /**
     * Get the latest "testimonial" image, cached for 1 hour.
     */
    public static function testimonialImage(): ?self {
        return Cache::remember('testimonial_image', 3600, fn() =>
            static::where('page', 'testimonial')
                ->where('status', 'active')
                ->latest()
                ->first()
        );
    }

    /**
     * Get the latest "authBanner" image, cached for 1 hour.
     */
    public static function authBanner(): ?self {
        return Cache::remember('authBanner', 3600, fn() =>
            static::where('page', 'auth')->where('status', 'active')->first()
        );
    }

    protected static function booted(): void {
        static::saved(function ($cmsImage) {
            if ($cmsImage->page === 'home') {
                Cache::forget('home_banners');
            }
            if ($cmsImage->page === 'testimonial') {
                Cache::forget('testimonial_image');
            }
            if ($cmsImage->page === 'auth') {
                Cache::forget('authBanner');
            }
        });

        static::deleted(function ($cmsImage) {
            if ($cmsImage->page === 'home') {
                Cache::forget('home_banners');
            }
            if ($cmsImage->page === 'testimonial') {
                Cache::forget('testimonial_image');
            }
            if ($cmsImage->page === 'auth') {
                Cache::forget('authBanner');
            }
        });
    }
}
