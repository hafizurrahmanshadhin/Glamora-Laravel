<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     ** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text',
        'status',
    ];

    /**
     *? The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'sender_id'   => 'integer',
        'receiver_id' => 'integer',
        'text'        => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    /**
     ** Get the sender of the message.
     */
    public function sender(): BelongsTo {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     ** Get the receiver of the message.
     */
    public function receiver(): BelongsTo {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
