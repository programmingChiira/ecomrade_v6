<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
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
        'title', 'slug', 'user_id', 'user_name', 'user_slug', 'resource_1', 'resource_2', 'resource_3', 'resource_4', 'resource_5', 'academic_year', 'course', 'club_id'
    ];

    public function resourcereviews()
    {
        return $this->hasMany(ResourceReview::class, 'resourceId');
    }

    public function getAverageRatingAttribute()
    {
        return $this->resourcereviews->avg('ratingValue');
    }

    public function getCountCommentAttribute()
    {
        return $this->resourcereviews->count('comment');
    }

}
