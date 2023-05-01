<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function marketcategory()
    {
        return $this->belongsTo(MarketCategory::class);
    }

    protected $fillable = [
        'slug', 'user_id', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'image_6', 'image_7', 'product_name', 'product_category', 'product_sub_category', 'product_description_1', 'product_description_2', 'product_description_4', 'product_description_5', 'product_description_6', 'product_description_7', 'product_more_info', 'size', 'gender', 'color', 'location', 'availability', 'contact', 'product_price', 'product_discount', 'product_service', 'club_id'
    ];

    public function marketreviews()
    {
        return $this->hasMany(MarketReview::class, 'marketId');
    }

    public function marketcarts()
    {
        //return $this->hasMany(MarketCart::class, 'marketId');
        //return $this->hasMany(MarketCart::class, 'marketId')->where('senderName', auth()->user()->id);

        return $this->hasMany(MarketCart::class, 'marketId')->where('senderId', auth()->user()->id ?? null);
    }

    public function carts()
    {
        return $this->belongsToMany(MarketCart::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->marketreviews->avg('ratingValue');
    }

    public function getCountCommentAttribute()
    {
        return $this->marketreviews->count('comment');
    }

    public function getCountMarketNameAttribute()
    {
        //return $this->marketcarts->count('marketName');
        //return $this->marketcarts()->where('senderName', auth()->user()->id)->whereNotNull('marketName')->count();
        return $this->marketcarts()->where('senderId', auth()->user()->id ?? null)->whereNotNull('marketName')->count();
    }
}
