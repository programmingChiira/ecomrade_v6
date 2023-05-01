<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalReviewResource;
use Illuminate\Http\Request;
use App\Models\RentalReview;
use Illuminate\Support\Facades\DB;

class RentalReviewController extends Controller
{
    public function store(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $senderName = $request->input('senderName');
        $senderId = $request->input('senderId');
        $userId = $request->input('userId');
        $rentalId = $request->input('rentalId');
        $rentalName = $request->input('rentalName');
        $rentalCat = $request->input('rentalCat');
        $comment = $request->input('comment');

        $rentalreview = new RentalReview();

        $rentalreview->ratingValue = $ratingValue;
        $rentalreview->senderName = $senderName;
        $rentalreview->senderId = $senderId;
        $rentalreview->userId = $userId;
        $rentalreview->rentalId = $rentalId;
        $rentalreview->rentalName = $rentalName;
        $rentalreview->rentalCat = $rentalCat;
        $rentalreview->comment = $comment;

        return $rentalreview->save();
    }

    public function index()
    {
        // $rentalcategories = RentalReview::get();
        // return RentalReviewResource::collection($rentalcategories);
        //return RentalReview::latest()->get();
        return RentalReviewResource::collection(RentalReview::latest()->get());
    }

    public function getSub()
    {
        return RentalReview::latest()->get();
    }

    public function show(RentalReview $rentalreview)
    {
        return $rentalreview;
    }

    public function update(Request $request, RentalReview $rentalreview)
    {
        $request->validate([
            'name' => 'required | unique:rental_reviews',
        ]);

        $name = $request->input('name');
        $rentalreview->name = $name;

        return $rentalreview->save();
    }

    public function destroy(RentalReview $rentalreview)
    {
        return $rentalreview->delete();
    }
}
