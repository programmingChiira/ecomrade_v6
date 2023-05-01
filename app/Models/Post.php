<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
        'title', 'slug', 'user_id', 'user_name', 'user_slug', 'post_category', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'body', 'club_id'
    ];

    public function postreviews()
    {
        return $this->hasMany(PostReview::class, 'postId');
    }

    public function getAverageRatingAttribute()
    {
        return $this->postreviews->avg('ratingValue');
    }

    public function getCountCommentAttribute()
    {
        return $this->postreviews->count('comment');
    }

}
