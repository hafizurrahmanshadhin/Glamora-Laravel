<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordReset extends Model {
    use HasFactory;

    protected $table = 'password_resets';

    protected $fillable = [
        'email',
        'phone_number',
        'otp',
        'created_at',
    ];

    public $timestamps = false;

    public function user(): BelongsTo {
        if ($this->email) {
            return $this->belongsTo(User::class, 'email', 'email');
        } else {
            return $this->belongsTo(User::class, 'phone_number', 'phone_number');
        }
    }
}
