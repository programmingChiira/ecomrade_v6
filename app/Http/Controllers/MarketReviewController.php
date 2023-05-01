<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketReviewResource;
use Illuminate\Http\Request;
use App\Models\MarketReview;
use Illuminate\Support\Facades\DB;

class MarketReviewController extends Controller
{
    public function store(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $senderName = $request->input('senderName');
        $senderId = $request->input('senderId');
        $userId = $request->input('userId');
        $marketId = $request->input('marketId');
        $marketName = $request->input('marketName');
        $marketCat = $request->input('marketCat');
        $comment = $request->input('comment');

        $marketreview = new MarketReview();

        $marketreview->ratingValue = $ratingValue;
        $marketreview->senderName = $senderName;
        $marketreview->senderId = $senderId;
        $marketreview->userId = $userId;
        $marketreview->marketId = $marketId;
        $marketreview->marketName = $marketName;
        $marketreview->marketCat = $marketCat;
        $marketreview->comment = $comment;

        return $marketreview->save();
    }

    public function index()
    {
        // $marketcategories = MarketReview::get();
        // return MarketReviewResource::collection($marketcategories);
        //return MarketReview::latest()->get();
        return MarketReviewResource::collection(MarketReview::latest()->get());
    }

    public function count($marketId)
    {
        // $reviewCount = MarketReview::where('marketId', $marketId)->count();
        // return $reviewCount;
        
        // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, COUNT(mc.marketName) AS marketName_count
        //     FROM market_reviews mr 
        //     INNER JOIN market_carts mc ON mr.marketId = mc.marketId
        //     WHERE mc.marketId = ?", [$marketId]);

        // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, mc.marketName, COUNT(DISTINCT mc.marketName) AS marketName_count 
        //     FROM market_reviews mr 
        //     INNER JOIN market_carts mc ON mr.marketId = mc.marketId
        //     WHERE mc.marketId = ?", [$marketId]);

        // return response()->json($data);
    }

    // public function averageRating(Request $request)
    // {
    //     $marketId = $request->input('marketId');
    //     $data = DB::select("SELECT AVG(ratingValue) AS avg_rating, COUNT(comment) AS comment_count FROM market_reviews WHERE marketId = ?, COUNT(marketName) AS marketName_count FROM market_carts WHERE marketId = ?", [$marketId]);
    //     return response()->json($data);
    // }

    public function getSub()
    {
        return MarketReview::latest()->get();
    }

    public function show(MarketReview $marketreview)
    {
        return $marketreview;
    }

    public function destroy(MarketReview $marketreview)
    {
        return $marketreview->delete();
    }
}
