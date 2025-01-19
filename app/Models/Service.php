<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected function casts(): array {
        return [
            'id'            => 'integer',
            'services_name' => 'string',
            'platform_fee'  => 'decimal:2',
            'status'        => 'string',
            'created_at'    => 'datetime',
            'updated_at'    => 'datetime',
            'deleted_at'    => 'datetime',
        ];
    }
}
