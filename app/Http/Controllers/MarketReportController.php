<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketReportResource;
use Illuminate\Http\Request;
use App\Models\MarketReport;
use Illuminate\Support\Facades\DB;

class MarketReportController extends Controller
{
    public function store(Request $request)
    {

        //dd($request);
        $marketreport = new MarketReport();

        $image_1 = $request->input('image_1');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $user_id = $request->input('user_id');
        $id = $request->input('id');
        $product_name = $request->input('product_name');
        $product_category = $request->input('product_category');
        $slug = $request->input('slug');
        $contact = $request->input('contact');

        $product_price = $request->input('product_price');
        $product_discount = $request->input('product_discount');

        $market_issue = $request->input('market_issue');
        $market_complaint = $request->input('market_complaint');


        // create and save marketreport

        $marketreport->marketImg = $image_1;
        $marketreport->senderName = $senderName;
        $marketreport->senderPhone = $senderPhone;
        $marketreport->senderId = $senderId;
        $marketreport->userId = $user_id;
        $marketreport->marketId = $id;
        $marketreport->marketName = $product_name;
        $marketreport->marketCat = $product_category;
        $marketreport->marketSlug = $slug;
        $marketreport->marketContact = $contact;
        $marketreport->marketPrice = $product_price;
        $marketreport->marketDiscount = $product_discount;
        $marketreport->marketIssue = $market_issue;
        $marketreport->marketComplaint = $market_complaint;
        $marketreport->save();
    }

    public function index()
    {
        // $marketcategories = MarketReport::get();
        // return MarketReportResource::collection($marketcategories);
        //return MarketReport::latest()->get();
        return MarketReportResource::collection(MarketReport::latest()->get());
    }

    // public function count($marketId)
    // {
    //     // $reviewCount = MarketReview::where('marketId', $marketId)->count();
    //     // return $reviewCount;

    //     // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, mc.marketName FROM market_reviews mr 
    //     // INNER JOIN market_reports WHERE mr.marketId = ?", [$marketId]);

    //     // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, mc.marketName 
    //     //     FROM market_reviews mr 
    //     //     INNER JOIN market_reports mc ON mr.marketId = mc.marketId
    //     //     WHERE mc.marketId = ?", [$marketId]);

    //     // return response()->json($data);
    // }

    // public function averageRating(Request $request)
    // {
    //     $marketId = $request->input('marketId');
    //     $data = DB::select("SELECT AVG(ratingValue) AS avg_rating, COUNT(comment) AS comment_count FROM market_reviews WHERE marketId = ?", [$marketId]);
    //     return response()->json($data);
    // }

    public function getSub()
    {
        return MarketReport::latest()->get();
    }

    public function show(MarketReport $marketreport)
    {
        return $marketreport;
    }

    public function update(Request $request, MarketReport $marketreport)
    {
        // $request->validate([
        //     'name' => 'required | unique:market_reports',
        // ]);

        // $name = $request->input('name');
        // $marketreport->name = $name;

        // return $marketreport->save();
    }

    public function destroy(MarketReport $marketreport)
    {
        return $marketreport->delete();
    }
}
