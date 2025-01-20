<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelRadius extends Model {
    use HasFactory, SoftDeletes;

    // Table name if it's different from the default (plural form of the model)
    protected $table = 'travel_radius';

    // Fillable attributes to protect against mass assignment vulnerabilities
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
    ];

    // Cast attributes to specific data types
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

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
