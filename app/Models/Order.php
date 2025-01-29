<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_id',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'id'           => 'integer',
        'user_id'      => 'integer',
        'booking_id'   => 'integer',
        'total_amount' => 'decimal:2',
        'status'       => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo {
        return $this->belongsTo(Booking::class);
    }
}
