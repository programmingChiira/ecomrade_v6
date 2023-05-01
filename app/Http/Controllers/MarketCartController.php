<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketCartResource;
use Illuminate\Http\Request;
use App\Models\MarketCart;
use Illuminate\Support\Facades\DB;

class MarketCartController extends Controller
{
    public function store(Request $request)
    {

        //dd($request);
        $marketcart = new MarketCart();

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


        // create and save marketcart

        $marketcart->marketImg = $image_1;
        $marketcart->senderName = $senderName;
        $marketcart->senderPhone = $senderPhone;
        $marketcart->senderId = $senderId;
        $marketcart->userId = $user_id;
        $marketcart->marketId = $id;
        $marketcart->marketName = $product_name;
        $marketcart->marketCat = $product_category;
        $marketcart->marketSlug = $slug;
        $marketcart->marketContact = $contact;
        $marketcart->marketPrice = $product_price;
        $marketcart->marketDiscount = $product_discount;
        $marketcart->save();
    }

    public function index()
    {
        // $marketcategories = MarketCart::get();
        // return MarketCartResource::collection($marketcategories);
        //return MarketCart::latest()->get();
        return MarketCartResource::collection(MarketCart::latest()->get());
    }

    // public function count($marketId)
    // {
    //     // $reviewCount = MarketReview::where('marketId', $marketId)->count();
    //     // return $reviewCount;

    //     // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, mc.marketName FROM market_reviews mr 
    //     // INNER JOIN market_carts WHERE mr.marketId = ?", [$marketId]);

    //     // $data = DB::select("SELECT AVG(mr.ratingValue) AS avg_rating, COUNT(mr.comment) AS comment_count, mc.marketName 
    //     //     FROM market_reviews mr 
    //     //     INNER JOIN market_carts mc ON mr.marketId = mc.marketId
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
        return MarketCart::latest()->get();
    }

    public function show(MarketCart $marketcart)
    {
        return $marketcart;
    }

    public function update(Request $request, MarketCart $marketcart)
    {
        // $request->validate([
        //     'name' => 'required | unique:market_carts',
        // ]);

        // $name = $request->input('name');
        // $marketcart->name = $name;

        // return $marketcart->save();
    }

    // public function destroy(MarketCart $marketcart)
    // {
    //     return $marketcart->delete();
    // }

    // public function destroy(MarketCart $marketcart)
    // {
    //     return $marketcart->delete();
    // }

    public function destroy(MarketCart $cart)
    {
        if (auth()->user()->id != $cart->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        $cart->delete();
        return response()->json(['message' => 'Cart item deleted successfully.']);
    }

}
