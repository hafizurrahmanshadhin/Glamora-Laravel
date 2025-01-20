<?php

namespace App\Models;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserService extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'service_id',
        'selected',
        'offered_price',
        'total_price',
        'image',
        'status',
    ];

    protected function casts(): array {
        return [
            'id'            => 'integer',
            'user_id'       => 'integer',
            'service_id'    => 'integer',
            'selected'      => 'boolean',
            'offered_price' => 'decimal',
            'total_price'   => 'decimal',
            'image'         => 'string',
            'status'        => 'string',
            'created_at'    => 'datetime',
            'updated_at'    => 'datetime',
            'deleted_at'    => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }
}
