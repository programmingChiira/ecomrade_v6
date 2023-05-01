<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function chatRoom()
    {
        return $this->belongsTo(ClubChatRoom::class);
    }

    protected $fillable = [
        'room_id', 'user_id'
    ];

}