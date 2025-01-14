<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DynamicPage extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'page_title',
        'page_slug',
        'page_content',
        'status',
    ];

    protected function casts(): array {
        return [
            'id'           => 'integer',
            'page_title'   => 'string',
            'page_slug'    => 'string',
            'page_content' => 'string',
            'status'       => 'string',
            'created_at'   => 'datetime',
            'updated_at'   => 'datetime',
            'deleted_at'   => 'datetime',
        ];
    }
}
