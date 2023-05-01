<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketSubCategory extends Model
{
    use HasFactory;

    public function marketcategories()
    {
        return $this->belongsTo(MarketCategory::class);
    }
}