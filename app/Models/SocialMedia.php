<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'social_media',
        'profile_link',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'social_media' => 'string',
            'profile_link' => 'string',
        ];
    }
}
