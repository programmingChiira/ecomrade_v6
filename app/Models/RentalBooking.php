<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalBooking extends Model
{
    use HasFactory;
    // public function rentals()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    protected $fillable = [
        'rentalImg','senderName','senderPhone','senderId','userId','rentalId','rentalName','rentalSlug','rentalCategory','rentalPrice','rentalInfo'
    ];

    public function rental()
    {
        return $this->belongsTo(Post::class);
    }
}