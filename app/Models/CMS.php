<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CMS extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'c_m_s';

    protected $fillable = [
        'section',
        'title',
        'sub_title',
        'content',
        'description',
        'image',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'          => 'integer',
        'section'     => 'string',
        'title'       => 'string',
        'sub_title'   => 'string',
        'content'     => 'string',
        'description' => 'string',
        'image'       => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    /**
     * Fetch the Join Us block, cached for 1 hour.
     */
    public static function joinUs(): ?self {
        return Cache::remember('join_us', 36, fn() =>
            static::where('section', 'join_us')->where('status', 'active')->first()
        );
    }

    /**
     * Fetch all user‐type‐container entries, cached for 1 hour.
     */
    public static function serviceTypes(): Collection {
        return Cache::remember('service_types', 3600, fn() =>
            static::where('section', 'user-type-container')->where('status', 'active')->orderBy('id')->get()
        );
    }

    /**
     * Fetch the user dashboard section, cached for 1 hour.
     */
    public static function userDashboard(): ?self {
        return Cache::remember('user_dashboard', 36, fn() =>
            static::where('section', 'user-dashboard')->first()
        );
    }

    /**
     * Fetch the home page banner, cached for 1 hour.
     */
    public static function homePageBanner(): ?self {
        return Cache::remember('home-page-banner', 36, fn() =>
            static::where('section', 'home-page-banner')->first()
        );
    }

    /**
     * Fetch the question mark text, cached for 1 hour.
     */
    public static function questionMarkText(): ?self {
        return Cache::remember('question-mark-text', 36, fn() =>
            static::where('section', 'question-mark-text')->first()
        );
    }

    /**
     * Fetch the profile review message, cached for 1 hour.
     */
    public static function profileReviewMessage(): ?self {
        return Cache::remember('profile-review-message', 36, fn() =>
            static::where('section', 'profile-review-message')->first()
        );
    }

    /**
     * Fetch the home counter section, cached for 1 hour.
     */
    public static function homeCounter(): Collection {
        return Cache::remember('home-counter', 36, fn() =>
            static::where('section', 'home-counter')->where('status', 'active')->orderBy('id', 'asc')->get()
        );
    }

    /**
     * Get all "home" banners, cached for 1 hour.
     */
    public static function homeBanners(): Collection {
        return Cache::remember('home_banners', 36, fn() =>
            static::where('section', 'home')->where('status', 'active')->get()
        );
    }

    /**
     * Get the latest "testimonial" image, cached for 1 hour.
     */
    public static function testimonialImage(): ?self {
        return Cache::remember('testimonial_image', 36, fn() =>
            static::where('section', 'testimonial')->where('status', 'active')->latest()->first()
        );
    }

    /**
     * Get the latest "authBanner" image, cached for 1 hour.
     */
    public static function authBanner(): ?self {
        return Cache::remember('authBanner', 36, fn() =>
            static::where('section', 'auth')->where('status', 'active')->first()
        );
    }

    protected static function booted(): void {
        static::saved(function ($cms) {
            if ($cms->section === 'join_us') {
                Cache::forget('join_us');
            }
            if ($cms->section === 'user-type-container') {
                Cache::forget('service_types');
            }
            if ($cms->section === 'user-dashboard') {
                Cache::forget('user_dashboard');
            }
            if ($cms->section === 'home-page-banner') {
                Cache::forget('home-page-banner');
            }
            if ($cms->section === 'question-mark-text') {
                Cache::forget('question-mark-text');
            }
            if ($cms->section === 'profile-review-message') {
                Cache::forget('profile-review-message');
            }
            if ($cms->section === 'home-counter') {
                Cache::forget('home-counter');
            }
            if ($cms->section === 'home') {
                Cache::forget('home_banners');
            }
            if ($cms->section === 'testimonial') {
                Cache::forget('testimonial_image');
            }
            if ($cms->section === 'auth') {
                Cache::forget('authBanner');
            }
        });

        static::deleted(function ($cms) {
            if ($cms->section === 'join_us') {
                Cache::forget('join_us');
            }
            if ($cms->section === 'user-type-container') {
                Cache::forget('service_types');
            }
            if ($cms->section === 'user-dashboard') {
                Cache::forget('user_dashboard');
            }
            if ($cms->section === 'home-page-banner') {
                Cache::forget('home-page-banner');
            }
            if ($cms->section === 'question-mark-text') {
                Cache::forget('question-mark-text');
            }
            if ($cms->section === 'profile-review-message') {
                Cache::forget('profile-review-message');
            }
            if ($cms->section === 'home-counter') {
                Cache::forget('home-counter');
            }
            if ($cms->section === 'home') {
                Cache::forget('home_banners');
            }
            if ($cms->section === 'testimonial') {
                Cache::forget('testimonial_image');
            }
            if ($cms->section === 'auth') {
                Cache::forget('authBanner');
            }
        });
    }
}
