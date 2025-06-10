<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model {
    use HasFactory;
    protected $table = 'c_m_s';

    protected $fillable = [
        'section',
        'title',
        'description',
        'image',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id'          => 'integer',
        'section'     => 'string',
        'title'       => 'string',
        'description' => 'string',
        'image'       => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
