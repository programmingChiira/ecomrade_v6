<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;
    // public function events()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    protected $fillable = [
        'eventImg','senderName','senderPhone','senderId','userId','eventId','eventTitle','eventSlug','eventDescription','eventDate','eventTime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}