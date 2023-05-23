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
