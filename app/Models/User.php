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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
            'unavailable_ranges'       => 'array',
            'weekend_data'             => 'array',
            'created_at'               => 'datetime',
            'updated_at'               => 'datetime',
            'deleted_at'               => 'datetime',
        ];
    }

    protected static function booted(): void {
        static::creating(function (User $user) {
            // if not explicitly set, give every new user full‐day availability
            if (is_null($user->weekend_data)) {
                $user->weekend_data = [
                    ['day' => 0, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 1, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 2, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 3, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 4, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 5, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                    ['day' => 6, 'time_from' => '12:00 AM', 'time_to' => '11:00 PM'],
                ];
            }
        });

        // Automatically hide users whose ban hasn't yet expired
        static::addGlobalScope('notBanned', function (Builder $q) {
            $q->whereNull('banned_until')
                ->orWhere('banned_until', '<=', now());
        });

        static::saved(function ($user) {
            if ($user->role === 'beauty_expert') {
                Cache::forget('top_beauty_experts');
            }
        });

        static::deleted(function ($user) {
            if ($user->role === 'beauty_expert') {
                Cache::forget('top_beauty_experts');
            }
            Cache::forget('latest_reviews'); // User relation in reviews
        });
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array {
        return [];
    }

    /**
     * Check if user is currently banned for manual checks
     */
    public function isBanned(): bool {
        return $this->banned_until && $this->banned_until->isFuture();
    }

    /**
     * Scope to include banned users when need to override global scope
     */
    public function scopeWithBanned(Builder $q): Builder {
        return $q->withoutGlobalScope('notBanned');
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
    public function receivedReviews(): HasManyThrough {
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
