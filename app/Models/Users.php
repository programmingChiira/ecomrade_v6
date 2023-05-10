<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id','name','slug','phone','email','type', 'youtube', 'instagram', 'twitter', 'facebook', 'linkedin', 'github', 'profile_pic', 'title', 'personal_description', 'campus_area','campus','gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(MarketCart::class);
    }
}
