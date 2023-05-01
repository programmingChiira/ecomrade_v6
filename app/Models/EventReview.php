<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReview extends Model
{
    use HasFactory;

    // public function events()
    // {
    //     return $this->belongsTo(Event::class);
    // }

    protected $fillable = [
        'ratingValue','senderName','senderId','userId','eventId','eventTitle','comment'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}