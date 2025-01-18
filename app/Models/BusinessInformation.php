<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BusinessInformation extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected function casts(): array {
        return [
            'id'                 => 'integer',
            'user_id'            => 'integer',
            'avatar'             => 'string',
            'name'               => 'string',
            'bio'                => 'string',
            'business_name'      => 'string',
            'professional_title' => 'string',
            'license'            => 'string',
            'status'             => 'string',
            'created_at'         => 'datetime',
            'updated_at'         => 'datetime',
            'deleted_at'         => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
