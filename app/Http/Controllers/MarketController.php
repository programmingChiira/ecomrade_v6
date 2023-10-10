<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketResource;
use App\Models\MarketCategory;
use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\MarketCart;
use App\Models\MarketReview;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $markets = MarketResource::collection(Market::where('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('product_price', 'like', '%' . $request->search . '%')
                ->orWhere('product_category', 'like', '%' . $request->search . '%')
                ->orWhere('product_sub_category', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_1', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_2', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_3', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_4', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_5', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_6', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_7', 'like', '%' . $request->search . '%')
                ->orWhere('product_more_info', 'like', '%' . $request->search . '%')
                ->orWhere('gender', 'like', '%' . $request->search . '%')
                ->orWhere('color', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhere('product_service', 'like', '%' . $request->search . '%')
                ->orWhere('product_discount', 'like', '%' . $request->search . '%')
                ->orWhere('size', 'like', '%' . $request->search . '%')
                ->latest()->with('marketreviews')->with('marketcarts')->paginate(10)->withQueryString());

            $marketData = $markets->map(function ($market) {
                $ratings = $market->marketReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;
                $carts = $market->marketcarts;
                $counter = $carts->count();

                $totalCartCount = MarketCart::where('senderId', auth()->id())
                    ->count();

                return [
                    'id' => $market->id,
                    'slug' => $market->slug,
                    'user_id' => $market->user_id,
                    'image_1' => $market->image_1,
                    'image_2' => $market->image_2,
                    'image_3' => $market->image_3,
                    'image_4' => $market->image_4,
                    'image_5' => $market->image_5,
                    'image_6' => $market->image_6,
                    'image_7' => $market->image_7,
                    'image_8' => $market->image_8,
                    'image_9' => $market->image_9,
                    'image_10' => $market->image_10,
                    'image_11' => $market->image_11,
                    'image_12' => $market->image_12,
                    'image_13' => $market->image_13,
                    'image_14' => $market->image_14,
                    'image_15' => $market->image_15,
                    'image_16' => $market->image_16,
                    'image_17' => $market->image_17,
                    'image_18' => $market->image_18,
                    'image_19' => $market->image_19,
                    'image_20' => $market->image_20,
                    'image_21' => $market->image_21,
                    'image_22' => $market->image_22,
                    'image_23' => $market->image_23,
                    'image_24' => $market->image_24,
                    'image_25' => $market->image_25,
                    'product_name' => $market->product_name,
                    'product_category' => $market->product_category,
                    'product_sub_category' => $market->product_sub_category,
                    'product_description_1' => $market->product_description_1,
                    'product_description_2' => $market->product_description_2,
                    'product_description_3' => $market->product_description_3,
                    'product_description_4' => $market->product_description_4,
                    'product_description_5' => $market->product_description_5,
                    'product_description_6' => $market->product_description_6,
                    'product_description_7' => $market->product_description_7,
                    'product_more_info' => $market->product_more_info,
                    'size' => $market->size,
                    'gender' => $market->gender,
                    'color' => $market->color,
                    'location' => $market->location,
                    'availability' => $market->availability,
                    'contact' => $market->contact,
                    'product_price' => $market->product_price,
                    'product_discount' => $market->product_discount,
                    'product_service' => $market->product_service,
                    'club_id' => $market->club_id,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                    'cart_count' => $counter,
                    'totalCartCount' => $totalCartCount,
                ];
            });

            return response()->json([
                'data' => $marketData,
                'current_page' => $markets->currentPage(),
                'last_page' => $markets->lastPage()
            ]);
        }
        $markets = MarketResource::collection(Market::latest()->with('marketreviews')->with('marketcarts')->paginate(20));

        $marketData = $markets->map(function ($market) {
            $ratings = $market->marketReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;
            $carts = $market->marketcarts;
            $counter = $carts->count();

            $totalCartCount = MarketCart::where('senderId', auth()->id())
                ->count();

            return [
                'id' => $market->id,
                'slug' => $market->slug,
                'user_id' => $market->user_id,
                'image_1' => $market->image_1,
                'image_2' => $market->image_2,
                'image_3' => $market->image_3,
                'image_4' => $market->image_4,
                'image_5' => $market->image_5,
                'image_6' => $market->image_6,
                'image_7' => $market->image_7,
                'image_8' => $market->image_8,
                'image_9' => $market->image_9,
                'image_10' => $market->image_10,
                'image_11' => $market->image_11,
                'image_12' => $market->image_12,
                'image_13' => $market->image_13,
                'image_14' => $market->image_14,
                'image_15' => $market->image_15,
                'image_16' => $market->image_16,
                'image_17' => $market->image_17,
                'image_18' => $market->image_18,
                'image_19' => $market->image_19,
                'image_20' => $market->image_20,
                'image_21' => $market->image_21,
                'image_22' => $market->image_22,
                'image_23' => $market->image_23,
                'image_24' => $market->image_24,
                'image_25' => $market->image_25,
                'product_name' => $market->product_name,
                'product_category' => $market->product_category,
                'product_sub_category' => $market->product_sub_category,
                'product_description_1' => $market->product_description_1,
                'product_description_2' => $market->product_description_2,
                'product_description_3' => $market->product_description_3,
                'product_description_4' => $market->product_description_4,
                'product_description_5' => $market->product_description_5,
                'product_description_6' => $market->product_description_6,
                'product_description_7' => $market->product_description_7,
                'product_more_info' => $market->product_more_info,
                'size' => $market->size,
                'gender' => $market->gender,
                'color' => $market->color,
                'location' => $market->location,
                'availability' => $market->availability,
                'contact' => $market->contact,
                'product_price' => $market->product_price,
                'product_discount' => $market->product_discount,
                'product_service' => $market->product_service,
                'club_id' => $market->club_id,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'cart_count' => $counter,
                'totalCartCount' => $totalCartCount,
            ];
        });

        return response()->json([
            'data' => $marketData,
            'current_page' => $markets->currentPage(),
            'last_page' => $markets->lastPage()
        ]);

        //return MarketResource::collection(Market::latest()->paginate(10));
    }

    public function count()
    {
        return MarketResource::collection(Market::latest()->get());
    }

    public function page(Request $request)
    {
        if ($request->search) {
            return  MarketResource::collection(
                Market::where('product_name', 'like', '%' . $request->search . '%')
                    ->orWhere('product_price', 'like', '%' . $request->search . '%')
                    ->orWhere('product_category', 'like', '%' . $request->search . '%')
                    ->orWhere('product_sub_category', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_1', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_2', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_3', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_4', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_5', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_6', 'like', '%' . $request->search . '%')
                    ->orWhere('product_description_7', 'like', '%' . $request->search . '%')
                    ->orWhere('product_more_info', 'like', '%' . $request->search . '%')
                    ->orWhere('gender', 'like', '%' . $request->search . '%')
                    ->orWhere('color', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%')
                    ->orWhere('product_service', 'like', '%' . $request->search . '%')
                    ->orWhere('product_discount', 'like', '%' . $request->search . '%')
                    ->orWhere('size', 'like', '%' . $request->search . '%')
                    ->latest()->paginate(1)->withQueryString()
            );
        }

        return MarketResource::collection(Market::latest()->paginate(10));
    }

    public function similarProds(Request $request)
    {
        $markets = MarketResource::collection(Market::latest()->with('marketreviews')->with('marketcarts')->paginate(6));

        $marketData = $markets->map(function ($market) {
            $ratings = $market->marketReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;
            $carts = $market->marketcarts;
            $counter = $carts->count();

            $totalCartCount = MarketCart::where('senderId', auth()->id())
                ->count();

            return [
                'id' => $market->id,
                'slug' => $market->slug,
                'user_id' => $market->user_id,
                'image_1' => $market->image_1,
                'image_2' => $market->image_2,
                'image_3' => $market->image_3,
                'image_4' => $market->image_4,
                'image_5' => $market->image_5,
                'image_6' => $market->image_6,
                'image_7' => $market->image_7,
                'image_8' => $market->image_8,
                'image_9' => $market->image_9,
                'image_10' => $market->image_10,
                'image_11' => $market->image_11,
                'image_12' => $market->image_12,
                'image_13' => $market->image_13,
                'image_14' => $market->image_14,
                'image_15' => $market->image_15,
                'image_16' => $market->image_16,
                'image_17' => $market->image_17,
                'image_18' => $market->image_18,
                'image_19' => $market->image_19,
                'image_20' => $market->image_20,
                'image_21' => $market->image_21,
                'image_22' => $market->image_22,
                'image_23' => $market->image_23,
                'image_24' => $market->image_24,
                'image_25' => $market->image_25,
                'product_name' => $market->product_name,
                'product_category' => $market->product_category,
                'product_sub_category' => $market->product_sub_category,
                'product_description_1' => $market->product_description_1,
                'product_description_2' => $market->product_description_2,
                'product_description_3' => $market->product_description_3,
                'product_description_4' => $market->product_description_4,
                'product_description_5' => $market->product_description_5,
                'product_description_6' => $market->product_description_6,
                'product_description_7' => $market->product_description_7,
                'product_more_info' => $market->product_more_info,
                'size' => $market->size,
                'gender' => $market->gender,
                'color' => $market->color,
                'location' => $market->location,
                'availability' => $market->availability,
                'contact' => $market->contact,
                'product_price' => $market->product_price,
                'product_discount' => $market->product_discount,
                'product_service' => $market->product_service,
                'club_id' => $market->club_id,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'cart_count' => $counter,
                'totalCartCount' => $totalCartCount,
            ];
        });

        return response()->json([
            'data' => $marketData,
            'current_page' => $markets->currentPage(),
            'last_page' => $markets->lastPage()
        ]);
    }

    public function home(Request $request)
    {
        if ($request->search) {
            $markets = MarketResource::collection(Market::where('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('product_price', 'like', '%' . $request->search . '%')
                ->orWhere('product_category', 'like', '%' . $request->search . '%')
                ->orWhere('product_sub_category', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_1', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_2', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_3', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_4', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_5', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_6', 'like', '%' . $request->search . '%')
                ->orWhere('product_description_7', 'like', '%' . $request->search . '%')
                ->orWhere('product_more_info', 'like', '%' . $request->search . '%')
                ->orWhere('gender', 'like', '%' . $request->search . '%')
                ->orWhere('color', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhere('product_service', 'like', '%' . $request->search . '%')
                ->orWhere('product_discount', 'like', '%' . $request->search . '%')
                ->orWhere('size', 'like', '%' . $request->search . '%')
                ->latest()->with('marketreviews')->with('marketcarts')->paginate(20)->withQueryString());

            $marketData = $markets->map(function ($market) {
                $ratings = $market->marketReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;
                $carts = $market->marketcarts;
                $counter = $carts->count();
                $totalCartCount = MarketCart::where('senderId', auth()->id())
                    ->count();

                return [
                    'id' => $market->id,
                    'slug' => $market->slug,
                    'user_id' => $market->user_id,
                    'image_1' => $market->image_1,
                    'image_2' => $market->image_2,
                    'image_3' => $market->image_3,
                    'image_4' => $market->image_4,
                    'image_5' => $market->image_5,
                    'image_6' => $market->image_6,
                    'image_7' => $market->image_7,
                    'image_8' => $market->image_8,
                    'image_9' => $market->image_9,
                    'image_10' => $market->image_10,
                    'image_11' => $market->image_11,
                    'image_12' => $market->image_12,
                    'image_13' => $market->image_13,
                    'image_14' => $market->image_14,
                    'image_15' => $market->image_15,
                    'image_16' => $market->image_16,
                    'image_17' => $market->image_17,
                    'image_18' => $market->image_18,
                    'image_19' => $market->image_19,
                    'image_20' => $market->image_20,
                    'image_21' => $market->image_21,
                    'image_22' => $market->image_22,
                    'image_23' => $market->image_23,
                    'image_24' => $market->image_24,
                    'image_25' => $market->image_25,
                    'product_name' => $market->product_name,
                    'product_category' => $market->product_category,
                    'product_sub_category' => $market->product_sub_category,
                    'product_description_1' => $market->product_description_1,
                    'product_description_2' => $market->product_description_2,
                    'product_description_3' => $market->product_description_3,
                    'product_description_4' => $market->product_description_4,
                    'product_description_5' => $market->product_description_5,
                    'product_description_6' => $market->product_description_6,
                    'product_description_7' => $market->product_description_7,
                    'product_more_info' => $market->product_more_info,
                    'size' => $market->size,
                    'gender' => $market->gender,
                    'color' => $market->color,
                    'location' => $market->location,
                    'availability' => $market->availability,
                    'contact' => $market->contact,
                    'product_price' => $market->product_price,
                    'product_discount' => $market->product_discount,
                    'product_service' => $market->product_service,
                    'club_id' => $market->club_id,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                    'cart_count' => $counter,
                    'totalCartCount' => $totalCartCount,
                ];
            });

            return response()->json([
                'data' => $marketData,
                'current_page' => $markets->currentPage(),
                'last_page' => $markets->lastPage()
            ]);
        }
        $markets = MarketResource::collection(Market::latest()->with('marketreviews')->with('marketcarts')->paginate(12));

        $marketData = $markets->map(function ($market) {
            $ratings = $market->marketReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;
            $carts = $market->marketcarts;
            $counter = $carts->count();
            $totalCartCount = MarketCart::where('senderId', auth()->id())
                ->count();

            return [
                'id' => $market->id,
                'slug' => $market->slug,
                'user_id' => $market->user_id,
                'image_1' => $market->image_1,
                'image_2' => $market->image_2,
                'image_3' => $market->image_3,
                'image_4' => $market->image_4,
                'image_5' => $market->image_5,
                'image_6' => $market->image_6,
                'image_7' => $market->image_7,
                'image_8' => $market->image_8,
                'image_9' => $market->image_9,
                'image_10' => $market->image_10,
                'image_11' => $market->image_11,
                'image_12' => $market->image_12,
                'image_13' => $market->image_13,
                'image_14' => $market->image_14,
                'image_15' => $market->image_15,
                'image_16' => $market->image_16,
                'image_17' => $market->image_17,
                'image_18' => $market->image_18,
                'image_19' => $market->image_19,
                'image_20' => $market->image_20,
                'image_21' => $market->image_21,
                'image_22' => $market->image_22,
                'image_23' => $market->image_23,
                'image_24' => $market->image_24,
                'image_25' => $market->image_25,
                'product_name' => $market->product_name,
                'product_category' => $market->product_category,
                'product_sub_category' => $market->product_sub_category,
                'product_description_1' => $market->product_description_1,
                'product_description_2' => $market->product_description_2,
                'product_description_3' => $market->product_description_3,
                'product_description_4' => $market->product_description_4,
                'product_description_5' => $market->product_description_5,
                'product_description_6' => $market->product_description_6,
                'product_description_7' => $market->product_description_7,
                'product_more_info' => $market->product_more_info,
                'size' => $market->size,
                'gender' => $market->gender,
                'color' => $market->color,
                'location' => $market->location,
                'availability' => $market->availability,
                'contact' => $market->contact,
                'product_price' => $market->product_price,
                'product_discount' => $market->product_discount,
                'product_service' => $market->product_service,
                'club_id' => $market->club_id,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'cart_count' => $counter,
                'totalCartCount' => $totalCartCount,
            ];
        });

        return response()->json([
            'data' => $marketData,
            'current_page' => $markets->currentPage(),
            'last_page' => $markets->lastPage()
        ]);
    }

    public function viewMarket($id)
    {
        $market = Market::find($id);
        session()->push('viewed_markets', $id);
        return view('market', ['market' => $market]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
        ]);
        $product_name = $request->product_name;

        if (!Market::count()) {
            $marketId = 1;
        } else {
            $marketId = Market::latest()->first()->id + 1;
        }

        $market = new Market();

        $slug = Str::slug($product_name, '-') . '-' . $marketId;
        $user_id = auth()->user()->id;
        $product_price = $request->input('product_price');
        $product_category = $request->input('product_category');
        $product_sub_category = $request->input('product_sub_category');
        $product_description_1 = $request->input('product_description_1');
        $product_description_2 = $request->input('product_description_2');
        $product_description_3 = $request->input('product_description_3');
        $product_description_4 = $request->input('product_description_4');
        $product_description_5 = $request->input('product_description_5');
        $product_description_6 = $request->input('product_description_6');
        $product_description_7 = $request->input('product_description_7');
        $product_more_info = $request->input('product_more_info');
        $size = $request->input('size');
        $gender = $request->input('gender');
        $color = $request->input('color');
        $location = $request->input('location');
        $availability = $request->input('availability');
        $contact = $request->input('contact');
        $product_discount = $request->input('product_discount');
        $product_service = $request->input('product_service');
        $club_id = $request->input('club_id');

        if ($request->file('file1')) {
            $request->validate([
                'file1' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $market->image_1 = $image_1;
        }


        if ($request->file('file2')) {
            $request->validate([
                'file2' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $market->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $request->validate([
                'file3' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $market->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $request->validate([
                'file4' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $market->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $request->validate([
                'file5' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $market->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            $request->validate([
                'file6' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image6 = $request->file('file6');
            $image_6 = $request->file('file6')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image6->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);
            $market->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            $request->validate([
                'file7' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image7 = $request->file('file7');
            $image_7 = $request->file('file7')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image7->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);
            $market->image_7 = $image_7;
        }

        if ($request->file('file8')) {
            $request->validate([
                'file8' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image8 = $request->file('file8');
            $image_8 = $request->file('file8')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image8->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_8);
            $market->image_8 = $image_8;
        }

        if ($request->file('file9')) {
            $request->validate([
                'file9' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image9 = $request->file('file9');
            $image_9 = $request->file('file9')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image9->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_9);
            $market->image_9 = $image_9;
        }

        if ($request->file('file10')) {
            $request->validate([
                'file10' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image10 = $request->file('file10');
            $image_10 = $request->file('file10')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image10->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_10);
            $market->image_10 = $image_10;
        }

        if ($request->file('file11')) {
            $request->validate([
                'file11' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image11 = $request->file('file11');
            $image_11 = $request->file('file11')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image11->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_11);
            $market->image_11 = $image_11;
        }

        if ($request->file('file12')) {
            $request->validate([
                'file12' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image12 = $request->file('file12');
            $image_12 = $request->file('file12')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image12->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_12);
            $market->image_12 = $image_12;
        }

        if ($request->file('file13')) {
            $request->validate([
                'file13' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image13 = $request->file('file13');
            $image_13 = $request->file('file13')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image13->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_13);
            $market->image_13 = $image_13;
        }

        if ($request->file('file14')) {
            $request->validate([
                'file14' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image14 = $request->file('file14');
            $image_14 = $request->file('file14')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image14->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_14);
            $market->image_14 = $image_14;
        }

        if ($request->file('file15')) {
            $request->validate([
                'file15' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image15 = $request->file('file15');
            $image_15 = $request->file('file15')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image15->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_15);
            $market->image_15 = $image_15;
        }

        if ($request->file('file16')) {
            $request->validate([
                'file16' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image16 = $request->file('file16');
            $image_16 = $request->file('file16')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image16->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_16);
            $market->image_16 = $image_16;
        }

        if ($request->file('file17')) {
            $request->validate([
                'file17' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image17 = $request->file('file17');
            $image_17 = $request->file('file17')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image17->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_17);
            $market->image_17 = $image_17;
        }

        if ($request->file('file18')) {
            $request->validate([
                'file18' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image18 = $request->file('file18');
            $image_18 = $request->file('file18')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image18->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_18);
            $market->image_18 = $image_18;
        }

        if ($request->file('file19')) {
            $request->validate([
                'file19' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image19 = $request->file('file19');
            $image_19 = $request->file('file19')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image19->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_19);
            $market->image_19 = $image_19;
        }

        if ($request->file('file20')) {
            $request->validate([
                'file20' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image20 = $request->file('file20');
            $image_20 = $request->file('file20')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image20->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_20);
            $market->image_20 = $image_20;
        }

        if ($request->file('file21')) {
            $request->validate([
                'file21' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image21 = $request->file('file21');
            $image_21 = $request->file('file21')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image21->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_21);
            $market->image_21 = $image_21;
        }

        if ($request->file('file22')) {
            $request->validate([
                'file22' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image22 = $request->file('file22');
            $image_22 = $request->file('file22')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image22->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_22);
            $market->image_22 = $image_22;
        }

        if ($request->file('file23')) {
            $request->validate([
                'file23' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image23 = $request->file('file23');
            $image_23 = $request->file('file23')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image23->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_23);
            $market->image_23 = $image_23;
        }

        if ($request->file('file24')) {
            $request->validate([
                'file24' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image24 = $request->file('file24');
            $image_24 = $request->file('file24')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image24->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_24);
            $market->image_24 = $image_24;
        }

        if ($request->file('file25')) {
            $request->validate([
                'file25' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            $image25 = $request->file('file25');
            $image_25 = $request->file('file25')->store('');
            $destinationPath = public_path('img/market');
            $img = Image::make($image25->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_25);
            $market->image_25 = $image_25;
        }

        // create and save market

        $market->product_name = $product_name;
        $market->slug = $slug;
        $market->user_id = $user_id;


        $market->product_price = $product_price;
        $market->product_category = $product_category;
        $market->product_sub_category = $product_sub_category;
        $market->product_description_1 = $product_description_1;
        $market->product_description_2 = $product_description_2;
        $market->product_description_3 = $product_description_3;
        $market->product_description_4 = $product_description_4;
        $market->product_description_5 = $product_description_5;
        $market->product_description_6 = $product_description_6;
        $market->product_description_7 = $product_description_7;
        $market->product_more_info = $product_more_info;
        $market->size = $size;
        $market->gender = $gender;
        $market->color = $color;
        $market->location = $location;
        $market->availability = $availability;
        $market->contact = $contact;
        $market->product_discount = $product_discount;
        $market->product_service = $product_service;
        $market->club_id = $club_id;
        $market->save();
    }

    public function show(Market $market)
    {
        //return new MarketResource($market);

        $markets = Market::find($market->id);
        $data = [
            "data" => $markets,
            "avg_rate" => $markets->average_rating,
            "comment_count" => $markets->count_comment,
            "marketName_count" => $markets->count_marketName,
        ];


        return response()->json($data);
    }

    public function update(Request $request, Market $market)
    {
        $request->validate([
            'product_name' => 'required',
            'file' => 'nullable | image',
        ]);


        if ($request->file('file1')) {
            $request->validate([
                'file1' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_1);

            $image = $request->file('file1');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_1 = $request->file('file1')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);

            $market->image_1 = $image_1;
        }

        if ($request->file('file2')) {
            $request->validate([
                'file2' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_2);

            $image = $request->file('file2');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_2 = $request->file('file2')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);

            $market->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $request->validate([
                'file3' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_3);

            $image = $request->file('file3');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_3 = $request->file('file3')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);

            $market->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $request->validate([
                'file4' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_4);

            $image = $request->file('file4');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_4 = $request->file('file4')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);

            $market->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $request->validate([
                'file5' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_5);

            $image = $request->file('file5');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_5 = $request->file('file5')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);

            $market->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            $request->validate([
                'file6' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_6);

            $image = $request->file('file6');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_6 = $request->file('file6')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);

            $market->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            $request->validate([
                'file7' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_7);

            $image = $request->file('file7');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_7 = $request->file('file7')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);

            $market->image_7 = $image_7;
        }

        if ($request->file('file8')) {
            $request->validate([
                'file8' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_8);

            $image = $request->file('file8');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_8 = $request->file('file8')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_8);

            $market->image_8 = $image_8;
        }

        if ($request->file('file9')) {
            $request->validate([
                'file9' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_9);

            $image = $request->file('file9');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_9 = $request->file('file9')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_9);

            $market->image_9 = $image_9;
        }

        if ($request->file('file10')) {
            $request->validate([
                'file10' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_10);

            $image = $request->file('file10');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_10 = $request->file('file10')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_10);

            $market->image_10 = $image_10;
        }

        if ($request->file('file11')) {
            $request->validate([
                'file11' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_11);

            $image = $request->file('file11');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_11 = $request->file('file11')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_11);

            $market->image_11 = $image_11;
        }
        if ($request->file('file12')) {
            $request->validate([
                'file12' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_12);

            $image = $request->file('file12');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_12 = $request->file('file12')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_12);

            $market->image_12 = $image_12;
        }

        if ($request->file('file13')) {
            $request->validate([
                'file13' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_13);

            $image = $request->file('file13');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_13 = $request->file('file13')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_13);

            $market->image_13 = $image_13;
        }

        if ($request->file('file14')) {
            $request->validate([
                'file14' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_14);

            $image = $request->file('file14');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_14 = $request->file('file14')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_14);

            $market->image_14 = $image_14;
        }

        if ($request->file('file15')) {
            $request->validate([
                'file15' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_15);

            $image = $request->file('file15');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_15 = $request->file('file15')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_15);

            $market->image_15 = $image_15;
        }

        if ($request->file('file16')) {
            $request->validate([
                'file16' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_16);

            $image = $request->file('file16');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_16 = $request->file('file16')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_16);

            $market->image_16 = $image_16;
        }

        if ($request->file('file17')) {
            $request->validate([
                'file17' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_17);

            $image = $request->file('file17');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_17 = $request->file('file17')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_17);

            $market->image_17 = $image_17;
        }

        if ($request->file('file18')) {
            $request->validate([
                'file18' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_18);

            $image = $request->file('file18');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_18 = $request->file('file18')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_18);

            $market->image_18 = $image_18;
        }

        if ($request->file('file19')) {
            $request->validate([
                'file19' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_19);

            $image = $request->file('file19');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_19 = $request->file('file19')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_19);

            $market->image_19 = $image_19;
        }

        if ($request->file('file20')) {
            $request->validate([
                'file20' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_20);

            $image = $request->file('file20');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_20 = $request->file('file20')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_20);

            $market->image_20 = $image_20;
        }

        if ($request->file('file21')) {
            $request->validate([
                'file21' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_21);

            $image = $request->file('file21');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_21 = $request->file('file21')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_21);

            $market->image_21 = $image_21;
        }

        if ($request->file('file22')) {
            $request->validate([
                'file22' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_22);

            $image = $request->file('file22');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_22 = $request->file('file22')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_22);

            $market->image_22 = $image_22;
        }

        if ($request->file('file23')) {
            $request->validate([
                'file23' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_23);

            $image = $request->file('file23');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_23 = $request->file('file23')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_23);

            $market->image_23 = $image_23;
        }

        if ($request->file('file24')) {
            $request->validate([
                'file24' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_24);

            $image = $request->file('file24');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_24 = $request->file('file24')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_24);

            $market->image_24 = $image_24;
        }

        if ($request->file('file25')) {
            $request->validate([
                'file25' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
            ]);
            File::delete($market->image_25);

            $image = $request->file('file25');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_25 = $request->file('file25')->store('');

            $destinationPath = public_path('img/market');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_25);

            $market->image_25 = $image_25;
        }
        

        // create and save post


        if ($request->product_name) {
            $product_name = $request->product_name;
            $market->product_name = $product_name;
        }

        if ($request->input('product_price')) {
            $product_price = $request->input('product_price');
            $market->product_price = $product_price;
        }

        if ($request->input('product_category')) {
            $product_category = $request->input('product_category');
            $market->product_category = $product_category;
        }

        if ($request->input('product_sub_category')) {
            $product_sub_category = $request->input('product_sub_category');
            $market->product_sub_category = $product_sub_category;
        }

        if ($request->input('product_description_1')) {
            $product_description_1 = $request->input('product_description_1');
            $market->product_description_1 = $product_description_1;
        }

        if ($request->input('product_description_2')) {
            $product_description_2 = $request->input('product_description_2');
            $market->product_description_2 = $product_description_2;
        }

        if ($request->input('product_description_3')) {
            $product_description_3 = $request->input('product_description_3');
            $market->product_description_3 = $product_description_3;
        }

        if ($request->input('product_description_4')) {
            $product_description_4 = $request->input('product_description_4');
            $market->product_description_4 = $product_description_4;
        }

        if ($request->input('product_description_5')) {
            $product_description_5 = $request->input('product_description_5');
            $market->product_description_5 = $product_description_5;
        }

        if ($request->input('product_description_6')) {
            $product_description_6 = $request->input('product_description_6');
            $market->product_description_6 = $product_description_6;
        }

        if ($request->input('product_description_7')) {
            $product_description_7 = $request->input('product_description_7');
            $market->product_description_7 = $product_description_7;
        }

        if ($request->input('product_more_info')) {
            $product_more_info = $request->input('product_more_info');
            $market->product_more_info = $product_more_info;
        }

        if ($request->input('size')) {
            $size = $request->input('size');
            $market->size = $size;
        }

        if ($request->input('gender')) {
            $gender = $request->input('gender');
            $market->gender = $gender;
        }

        if ($request->input('color')) {
            $color = $request->input('color');
            $market->color = $color;
        }

        if ($request->input('location')) {
            $location = $request->input('location');
            $market->location = $location;
        }

        if ($request->input('availability')) {
            $availability = $request->input('availability');
            $market->availability = $availability;
        }

        if ($request->input('contact')) {
            $contact = $request->input('contact');
            $market->contact = $contact;
        }

        if ($request->input('product_discount')) {
            $product_discount = $request->input('product_discount');
            $market->product_discount = $product_discount;
        }

        if ($request->input('product_service')) {
            $product_service = $request->input('product_service');
            $market->product_service = $product_service;
        }

        $market->save();
    }

    public function destroy(Market $market)
    {

        return $market->delete();
    }
}
