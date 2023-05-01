<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubChatRoom extends Model
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

    public function clubchats()
    {
        return $this->belongsTo(Club::class, 'id');
    }

    protected $fillable = [
        'room_id', 'user_id', 'user_name', 'user_slug', 'image_1', 'message'
    ];

}