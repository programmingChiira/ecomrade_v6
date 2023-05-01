<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalReportResource;
use Illuminate\Http\Request;
use App\Models\RentalReport;
use Illuminate\Support\Facades\DB;

class RentalReportController extends Controller
{
    public function store(Request $request)
    {

        //dd($request);
        $rentalreport = new RentalReport();

        $image_1 = $request->input('image_1');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $user_id = $request->input('user_id');
        $id = $request->input('id');
        $rental_name = $request->input('rental_name');
        $rental_category = $request->input('rental_category');
        $slug = $request->input('slug');
        $contact = $request->input('contact');

        $rental_issue = $request->input('rental_issue');
        $rental_complaint = $request->input('rental_complaint');


        // create and save rentalreport

        $rentalreport->rentalImg = $image_1;
        $rentalreport->senderName = $senderName;
        $rentalreport->senderPhone = $senderPhone;
        $rentalreport->senderId = $senderId;
        $rentalreport->userId = $user_id;
        $rentalreport->rentalId = $id;
        $rentalreport->rentalName = $rental_name;
        $rentalreport->rentalCat = $rental_category;
        $rentalreport->rentalSlug = $slug;
        $rentalreport->rentalContact = $contact;
        $rentalreport->rentalIssue = $rental_issue;
        $rentalreport->rentalComplaint = $rental_complaint;
        $rentalreport->save();
    }

    public function index()
    {
        return RentalReportResource::collection(RentalReport::latest()->get());
    }

    public function update(Request $request, RentalReport $rentalreport)
    {
        //
    }

    public function destroy(RentalReport $rentalreport)
    {
        //
    }
}
