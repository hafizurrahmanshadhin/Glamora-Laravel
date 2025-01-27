<?php

namespace App\Models;

use App\Models\UserService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'services_name',
        'platform_fee',
        'status',
    ];

    protected $casts = [
        'id'            => 'integer',
        'services_name' => 'string',
        'platform_fee'  => 'integer',
        'status'        => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function userServices(): HasMany {
        return $this->hasMany(UserService::class);
    }
}
