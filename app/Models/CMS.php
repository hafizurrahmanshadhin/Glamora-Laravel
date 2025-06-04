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
        'content',
        'image',
        'items',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'         => 'integer',
        'section'    => 'string',
        'title'      => 'string',
        'content'    => 'string',
        'image'      => 'string',
        'items'      => 'array',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function setItemsAttribute($value): void {
        if (is_array($value)) {
            $this->attributes['items'] = json_encode($value);
        } else {
            $this->attributes['items'] = null;
        }
    }

    public function getItemsAttribute($value): mixed {
        return is_array($value) ? $value : json_decode($value, true);
    }
}
