<?php

namespace App\Models;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class UserService extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user_services';

    protected $fillable = [
        'id',
        'user_id',
        'service_id',
        'selected',
        'offered_price',
        'total_price',
        'image',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'service_id'    => 'integer',
        'selected'      => 'boolean',
        'offered_price' => 'decimal:2',
        'total_price'   => 'decimal:2',
        'image'         => 'string',
        'status'        => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    protected static function booted(): void {
        static::saved(function () {
            Cache::forget('approved_services');
        });

        static::deleted(function () {
            Cache::forget('approved_services');
        });
    }

    /**
     * Scope for active services with non-banned users
     */
    public function scopeActive(Builder $q): Builder {
        return $q->where('status', 'active')->whereHas('user');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }
}
