<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Booking extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_service_id',
        'service_type',
        'appointment_date',
        'appointment_time',
        'price',
        'status',
    ];

    protected $casts = [
        'id'               => 'integer',
        'user_id'          => 'integer',
        'user_service_id'  => 'integer',
        'service_type'     => 'string',
        'appointment_date' => 'date',
        'appointment_time' => 'string',
        'price'            => 'decimal:2',
        'status'           => 'string',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function userService(): BelongsTo {
        return $this->belongsTo(UserService::class, 'user_service_id');
    }
}
