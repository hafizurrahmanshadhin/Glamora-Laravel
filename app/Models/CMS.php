<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
