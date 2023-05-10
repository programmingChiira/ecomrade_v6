<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rentalcategory()
    {
        return $this->belongsTo(RentalCategory::class);
    }

    protected $fillable = [
        'user_id','slug','contact_information','rental_name','rental_category','no_of_rooms','maps','rental_area','vacancy_status','rental_price','pay_per','image_1','image_2','image_3','image_4','image_5','image_6','image_7','rental_description_1','rental_description_2','rental_description_3','rental_description_4','rental_description_5','rental_description_6','rental_description_7','rental_description_8','rental_more_info'
    ];

    public function rentalreviews()
    {
        return $this->hasMany(RentalReview::class, 'rentalId');
    }

    public function rentalbookings()
    {
        return $this->hasMany(RentalBooking::class, 'rentalId');

    }

    public function carts()
{
    return $this->belongsToMany(RentalCart::class);
}

    public function getAverageRatingAttribute()
    {
        return $this->rentalreviews->avg('ratingValue');
    }

    public function getCountCommentAttribute()
    {
        return $this->rentalreviews->count('comment');
    }

    public function getCountBookingAttribute()
    {
        return $this->rentalbookings->count('rentalId');
    }

    public function getCountRentalNameAttribute()
    {
        //return $this->rentalcarts->count('rentalName');
        //return $this->rentalcarts()->where('senderName', auth()->user()->id)->whereNotNull('rentalName')->count();
        return $this->rentalcarts()->where('senderId', auth()->user()->id ?? null)->whereNotNull('rentalName')->count();

    }

}
