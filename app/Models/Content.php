<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model {
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected function casts(): array {
        return [
            'id'         => 'integer',
            'type'       => 'string',
            'title'      => 'string',
            'slug'       => 'string',
            'content'    => 'string',
            'status'     => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
