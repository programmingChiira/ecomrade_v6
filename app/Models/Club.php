<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'id','name', 'slug', 'user_id', 'user_slug', 'image_1', 'description'
    ];

    public function clubchats()
    {
        return $this->hasMany(ClubChatRoom::class, 'room_id');
    }

    public function clubarticles()
    {
        return $this->hasMany(Post::class, 'club_id');
    }

    public function clubmarkets()
    {
        return $this->hasMany(Market::class, 'club_id');
    }

    public function clubevents()
    {
        return $this->hasMany(Event::class, 'club_id');
    }

    public function clubpolls()
    {
        return $this->hasMany(Poll::class, 'club_id');
    }

    public function clubresources()
    {
        return $this->hasMany(Resource::class, 'club_id');
    }

    public function clubusers()
    {
        return $this->hasMany(RoomUser::class, 'room_id');
    }

    public function getCountMessageAttribute()
    {
        return $this->clubchats->count('message');
    }

}
