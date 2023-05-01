<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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
        'title', 'slug', 'user_id', 'user_name', 'user_slug', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'description', 'requirement_1', 'requirement_2', 'requirement_3', 'requirement_4', 'requirement_5', 'mode', 'area', 'location', 'date', 'time', 'entry', 'entry_cost', 'contact', 'show_contact', 'club_id'
    ];

    public function eventreviews()
    {
        return $this->hasMany(EventReview::class, 'eventId');
    }

    public function getAverageRatingAttribute()
    {
        return $this->eventreviews->avg('ratingValue');
    }

    public function getCountCommentAttribute()
    {
        return $this->eventreviews->count('comment');
    }

}
