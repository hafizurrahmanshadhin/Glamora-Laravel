<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NewsletterSubscription extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
    ];

    protected $casts = [
        'id'         => 'integer',
        'email'      => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
