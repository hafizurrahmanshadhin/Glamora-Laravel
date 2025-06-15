<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model {
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array {
        return [
            'id'             => 'integer',
            'title'          => 'string',
            'system_name'    => 'string',
            'email'          => 'string',
            'phone_number'   => 'string',
            'address'        => 'string',
            'copyright_text' => 'string',
            'description'    => 'string',
            'logo'           => 'string',
            'favicon'        => 'string',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
        ];
    }

    /**
     * Fetch the current system settings, cached for 1 hour.
     */
    public static function current(): ?self {
        return Cache::remember('system_setting', 3600, fn() => static::first());
    }

    protected static function booted(): void {
        static::saved(function () {
            Cache::forget('system_setting');
        });

        static::deleted(function () {
            Cache::forget('system_setting');
        });
    }
}
