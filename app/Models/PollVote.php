<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    // public function polls()
    // {
    //     return $this->belongsTo(Market::class);
    // }

    protected $fillable = [
        'senderName', 'senderId', 'userId', 'pollId', 'pollTitle', 'vote'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

}
