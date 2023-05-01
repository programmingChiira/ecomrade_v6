<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pollcategory()
    {
        return $this->belongsTo(PollCategory::class);
    }

    protected $fillable = [
        'user_id', 'slug', 'contact', 'user_name', 'title', 'argument', 'show_owner', 'owner_slug', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'image_6', 'image_7', 'image_8', 'image_9', 'image_10', 'option_1', 'option_2', 'option_3', 'option_4', 'option_5', 'option_6', 'option_7', 'option_8', 'option_9', 'option_10', 'club_id'
    ];

    public function pollvotes()
    {
        return $this->hasMany(PollVote::class, 'pollId');
    }

    public function getCountVoteAttribute()
    {
        return $this->pollvotes->count('vote');
    }

    public function pollvotesid()
    {
        //return $this->hasMany(MarketCart::class, 'pollId');
        //return $this->hasMany(MarketCart::class, 'pollId')->where('senderName', auth()->user()->id);

        return $this->hasMany(PollVote::class, 'pollId')->where('senderId', auth()->user()->id ?? null);
    }

    public function getVoterIdAttribute()
    {
        return $this->pollvotesid()->where('senderId', auth()->user()->id ?? null)->whereNotNull('pollTitle')->count();
    }

}
