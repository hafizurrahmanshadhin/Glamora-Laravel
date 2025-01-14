<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsFeedback extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rating',
        'description',
        'name',
        'title',
    ];

    protected function casts(): array {
        return [
            'id'          => 'integer',
            'rating'      => 'integer',
            'description' => 'string',
            'name'        => 'string',
            'title'       => 'string',
            'status'      => 'string',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
            'deleted_at'  => 'datetime',
        ];
    }
}
