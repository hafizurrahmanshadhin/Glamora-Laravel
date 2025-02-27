<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CMSImage extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'image',
        'page',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'image'      => 'string',
        'page'       => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
