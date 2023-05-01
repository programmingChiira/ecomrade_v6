<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketReport extends Model
{
    use HasFactory;
    // public function markets()
    // {
    //     return $this->belongsTo(Market::class);
    // }

    protected $fillable = [
        'marketImg','senderName','senderPhone','senderId','userId','marketId','marketName','marketCat','marketSlug','marketContact','marketPrice','marketDiscount','marketIssue','marketComplaint'
    ];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}