<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CMS extends Model {
    use HasFactory;
    protected $table = 'c_m_s';

    protected $fillable = [
        'section',
        'title',
        'description',
        'image',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id'          => 'integer',
        'section'     => 'string',
        'title'       => 'string',
        'description' => 'string',
        'image'       => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /**
     * Fetch the Join Us block, cached for 1 hour.
     */
    public static function joinUs(): ?self {
        return Cache::remember('join_us', 3600, fn() =>
            static::where('section', 'join_us')
                ->where('status', 'active')
                ->first()
        );
    }

    /**
     * Fetch all user‐type‐container entries, cached for 1 hour.
     */
    public static function serviceTypes(): Collection {
        return Cache::remember('service_types', 3600, fn() =>
            static::where('section', 'user-type-container')
                ->where('status', 'active')
                ->orderBy('id')
                ->get()
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
        });

        static::deleted(function ($cms) {
            if ($cms->section === 'join_us') {
                Cache::forget('join_us');
            }
            if ($cms->section === 'user-type-container') {
                Cache::forget('service_types');
            }
        });
    }
}
