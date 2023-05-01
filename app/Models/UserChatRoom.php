<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChatRoom extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userchats()
    {
        return $this->belongsTo(User::class, 'id');
    }

    protected $fillable = [
        'receiver_id', 'user_id', 'user_name', 'user_slug', 'image_1', 'message'
    ];

}