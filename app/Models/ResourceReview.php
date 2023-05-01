<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceReview extends Model
{
    use HasFactory;

    // public function resources()
    // {
    //     return $this->belongsTo(Resource::class);
    // }

    protected $fillable = [
        'ratingValue','senderName','senderId','userId','resourceId','resourceTitle','comment'
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}