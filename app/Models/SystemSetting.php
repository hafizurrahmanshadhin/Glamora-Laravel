<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model {
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array {
        return [
            'id'             => 'integer',
            'title'          => 'string',
            'system_name'    => 'string',
            'email'          => 'string',
            'phone_number'   => 'string',
            'address'        => 'string',
            'copyright_text' => 'string',
            'description'    => 'string',
            'logo'           => 'string',
            'favicon'        => 'string',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
        ];
    }
}
