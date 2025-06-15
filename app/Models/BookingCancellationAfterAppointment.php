<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BookingCancellationAfterAppointment extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'canceled_by',
        'requested_by',
    ];

    protected $casts = [
        'id'           => 'integer',
        'booking_id'   => 'integer',
        'canceled_by'  => 'integer',
        'requested_by' => 'integer',
        'status'       => 'string',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    public function booking(): BelongsTo {
        return $this->belongsTo(Booking::class);
    }

    public function canceledBy() {
        return $this->belongsTo(User::class, 'canceled_by')->withBanned();
    }

    public function requestedBy() {
        return $this->belongsTo(User::class, 'requested_by')->withBanned();
    }
}
