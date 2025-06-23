<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelRadius extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'travel_radius';

    protected $fillable = [
        'id',
        'user_id',
        'free_radius',
        'travel_radius',
        'travel_charge',
        'max_radius',
        'max_charge',
        'min_booking_value',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'id'                => 'integer',
            'user_id'           => 'integer',
            'free_radius'       => 'integer',
            'travel_radius'     => 'integer',
            'travel_charge'     => 'decimal:2',
            'max_radius'        => 'integer',
            'max_charge'        => 'decimal:2',
            'min_booking_value' => 'decimal:2',
            'status'            => 'string',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
            'deleted_at'        => 'datetime',
        ];
    }

    public function scopeActive(Builder $q): Builder {
        return $q->where('status', 'active')->whereHas('user');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
