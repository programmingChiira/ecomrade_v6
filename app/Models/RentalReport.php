<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalReport extends Model
{
    use HasFactory;
    // public function rentals()
    // {
    //     return $this->belongsTo(Rental::class);
    // }

    protected $fillable = [
        'rentalImg','senderName','senderPhone','senderId','userId','rentalId','rentalName','rentalCat','rentalSlug','rentalContact','rentalPrice','rentalDiscount','rentalIssue','rentalComplaint'
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}