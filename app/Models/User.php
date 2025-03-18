<?php

namespace App\Models;

use App\Models\AdminComment;
use App\Models\Booking;
use App\Models\BookingCancellationAfterAppointment;
use App\Models\BookingCancellationBeforeAppointment;
use App\Models\BusinessInformation;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Review;
use App\Models\TravelRadius;
use App\Models\UserGallery;
use App\Models\UserService;
use App\Models\UserTool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'id'                       => 'integer',
            'first_name'               => 'string',
            'last_name'                => 'string',
            'email'                    => 'string',
            'phone_number'             => 'string',
            'address'                  => 'string',
            'email_verified_at'        => 'datetime',
            'phone_number_verified_at' => 'datetime',
            'password'                 => 'hashed',
            'avatar'                   => 'string',
            'cover_photo'              => 'string',
            'google_id'                => 'string',
            'role'                     => 'string',
            'status'                   => 'string',
            'banned_until'             => 'datetime',
            'availability'             => 'string',
            'created_at'               => 'datetime',
            'updated_at'               => 'datetime',
            'deleted_at'               => 'datetime',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array {
        return [];
    }

    public function businessInformation(): HasOne {
        return $this->hasOne(BusinessInformation::class);
    }

    public function userTools(): HasMany {
        return $this->hasMany(UserTool::class);
    }

    public function userGalleries(): HasMany {
        return $this->hasMany(UserGallery::class);
    }

    public function userServices(): HasMany {
        return $this->hasMany(UserService::class);
    }

    public function travelRadius(): HasOne {
        return $this->hasOne(TravelRadius::class);
    }

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

    public function reports(): HasMany {
        return $this->hasMany(Report::class);
    }

    public function bookingCancellationBeforeAppointments(): HasMany {
        return $this->hasMany(BookingCancellationBeforeAppointment::class, 'canceled_by');
    }

    public function bookingCancellationBeforeAppointmentRequests(): HasMany {
        return $this->hasMany(BookingCancellationBeforeAppointment::class, 'requested_by');
    }

    public function bookingCancellationAfterAppointments(): HasMany {
        return $this->hasMany(BookingCancellationAfterAppointment::class, 'canceled_by');
    }

    public function bookingCancellationAfterAppointmentRequests(): HasMany {
        return $this->hasMany(BookingCancellationAfterAppointment::class, 'requested_by');
    }

    public function adminComments(): HasMany {
        return $this->hasMany(AdminComment::class);
    }

    /**
     * Get all reviews received by the user as a beauty expert.
     */
    public function receivedReviews() {
        return $this->hasManyThrough(
            Review::class,
            Booking::class,
            'user_service_id', // Foreign key on Booking table...
            'booking_id', // Foreign key on Review table...
            'id', // Local key on User table...
            'id' // Local key on Booking table...
        );
    }
}
