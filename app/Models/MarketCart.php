<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCart extends Model
{
    use HasFactory;
    // public function markets()
    // {
    //     return $this->belongsTo(Market::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markets()
    {
        return $this->hasMany(Market::class);
    }
}
