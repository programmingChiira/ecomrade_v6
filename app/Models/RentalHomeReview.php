<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalHomeReview extends Model
{
    use HasFactory;

    // public function rentals()
    // {
    //     return $this->belongsTo(Rental::class);
    // }

    protected $fillable = [
        'ratingValue','senderName','senderId','userId','rentalId','rentalName','rentalCat','comment'
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}