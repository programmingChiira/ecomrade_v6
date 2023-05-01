<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;
    // public function posts()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    protected $fillable = [
        'postImg','senderName','senderPhone','senderId','userId','postId','postName','postCat','postSlug','postIssue','postComplaint'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}