<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketHomeReview extends Model
{
    use HasFactory;

    // public function markets()
    // {
    //     return $this->belongsTo(Market::class);
    // }

    protected $fillable = [
        'ratingValue','senderName','senderId','userId','marketId','marketName','marketCat','comment'
    ];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}