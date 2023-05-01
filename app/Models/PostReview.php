<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReview extends Model
{
    use HasFactory;

    // public function posts()
    // {
    //     return $this->belongsTo(Post::class);
    // }
    
    protected $fillable = [
        'ratingValue','senderName','senderId','userId','postId','postName','postCat','comment'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}