<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Review extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_id',
        'review',
        'rating',
    ];

    protected function casts(): array {
        return [
            'id'         => 'integer',
            'user_id'    => 'integer',
            'booking_id' => 'integer',
            'review'     => 'string',
            'rating'     => 'integer',
            'status'     => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected static function booted(): void {
        static::saved(function () {
            Cache::forget('review_stats');
            Cache::forget('latest_reviews');
        });

        static::deleted(function () {
            Cache::forget('review_stats');
            Cache::forget('latest_reviews');
        });
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo {
        return $this->belongsTo(Booking::class);
    }
}
