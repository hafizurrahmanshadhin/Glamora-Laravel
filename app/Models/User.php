<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\BusinessInformation;
use App\Models\TravelRadius;
use App\Models\UserService;
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
            'id'                => 'integer',
            'first_name'        => 'string',
            'last_name'         => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'avatar'            => 'string',
            'cover_photo'       => 'string',
            'google_id'         => 'string',
            'role'              => 'string',
            'status'            => 'string',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
            'deleted_at'        => 'datetime',
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

    public function userServices(): HasMany {
        return $this->hasMany(UserService::class);
    }

    public function travelRadius(): HasOne {
        return $this->hasOne(TravelRadius::class);
    }

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }
}
