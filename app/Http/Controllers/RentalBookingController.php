<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalBookingResource;
use Illuminate\Http\Request;
use App\Models\RentalBooking;
use Illuminate\Support\Facades\DB;

class RentalBookingController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();
        $rentalId = $request->input('rentalId');

        // check if the user has already booked the rental
        $bookingExists = RentalBooking::where('senderId', $user->id)->where('rentalId', $rentalId)->exists();
        if ($bookingExists) {
            return response()->json(['message' => 'You have already booked this rental.'], 409);
        }


        $rentalreport = new RentalBooking();

        $rentalImage = $request->input('rentalImage');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $userId = $request->input('userId');
        $rentalId = $request->input('rentalId');
        $rentalName = $request->input('rentalName');
        $rentalSlug = $request->input('rentalSlug');
        $rentalCategory = $request->input('rentalCategory');
        $rentalPrice = $request->input('rentalPrice');
        $rentalInfo = $request->input('rentalInfo');


        // create and save rentalreport

        $rentalreport->rentalImg = $rentalImage;
        $rentalreport->senderName = $senderName;
        $rentalreport->senderPhone = $senderPhone;
        $rentalreport->senderId = $senderId;
        $rentalreport->userId = $userId;
        $rentalreport->rentalId = $rentalId;
        $rentalreport->rentalName = $rentalName;
        $rentalreport->rentalSlug = $rentalSlug;
        $rentalreport->rentalCategory = $rentalCategory;
        $rentalreport->rentalPrice = $rentalPrice;
        $rentalreport->rentalInfo = $rentalInfo;
        $rentalreport->save();
    }

    public function index()
    {
        // $rentalcategories = RentalBooking::get();
        // return RentalBookingResource::collection($rentalcategories);
        //return RentalBooking::latest()->get();
        return RentalBookingResource::collection(RentalBooking::latest()->get());
    }

    public function getSub()
    {
        return RentalBooking::latest()->get();
    }

    public function show(RentalBooking $rentalreport)
    {
        return $rentalreport;
    }

    public function update(Request $request, RentalBooking $rentalreport)
    {
        // $request->validate([
        //     'name' => 'required | unique:rental_reports',
        // ]);

        // $name = $request->input('name');
        // $rentalreport->name = $name;

        // return $rentalreport->save();
    }

    public function destroy(RentalBooking $rentalreport)
    {
        return $rentalreport->delete();
    }
}
