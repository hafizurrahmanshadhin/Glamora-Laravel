<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
            'id'                   => 'integer',
            'email_verified_at'    => 'datetime',
            'otp_verified_at'      => 'datetime',
            'password'             => 'hashed',
            'name'                 => 'string',
            'first_name'           => 'string',
            'last_name'            => 'string',
            'user_name'            => 'string',
            'email'                => 'string',
            'phone_number'         => 'string',
            "language"             => 'string',
            'avatar'               => 'string',
            'cover_photo'          => 'string',
            'address'              => 'string',
            'google_id'            => 'string',
            'facebook_id'          => 'string',
            'apple_id'             => 'string',
            'role'                 => 'string',
            'status'               => 'string',
            'terms_and_conditions' => 'boolean',
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
            'deleted_at'           => 'datetime',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array {
        return [];
    }
}
