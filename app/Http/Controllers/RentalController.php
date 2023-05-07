<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalResource;
use App\Models\RentalCategory;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\RentalReview;
use App\Models\RentalBooking;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $rentals = RentalResource::collection(Rental::where('rental_name', 'like', '%' . $request->search . '%')
                ->orWhere('contact_information', 'like', '%' . $request->search . '%')
                ->orWhere('rental_category', 'like', '%' . $request->search . '%')
                ->orWhere('no_of_rooms', 'like', '%' . $request->search . '%')
                ->orWhere('vacancy_status', 'like', '%' . $request->search . '%')
                ->orWhere('rental_price', 'like', '%' . $request->search . '%')
                ->orWhere('pay_per', 'like', '%' . $request->search . '%')
                ->orWhere('rental_area', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_1', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_2', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_3', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_4', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_5', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_6', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_7', 'like', '%' . $request->search . '%')
                ->orWhere('rental_description_8', 'like', '%' . $request->search . '%')
                ->orWhere('rental_more_info', 'like', '%' . $request->search . '%')
                ->latest()->with('rentalreviews')->paginate(10)->withQueryString());

            $rentalData = $rentals->map(function ($rental) {
                $ratings = $rental->rentalReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;

                return [
                    'id' => $rental->id,
                    'user_id' => $rental->user_id,
                    'slug' => $rental->slug,
                    'contact_information' => $rental->contact_information,
                    'rental_name' => $rental->rental_name,
                    'rental_category' => $rental->rental_category,
                    'no_of_rooms' => $rental->no_of_rooms,
                    'maps' => $rental->maps,
                    'rental_area' => $rental->rental_area,
                    'vacancy_status' => $rental->vacancy_status,
                    'rental_price' => $rental->rental_price,
                    'pay_per' => $rental->pay_per,
                    'image_1' => $rental->image_1,
                    'image_2' => $rental->image_2,
                    'image_3' => $rental->image_3,
                    'image_4' => $rental->image_4,
                    'image_5' => $rental->image_5,
                    'image_6' => $rental->image_6,
                    'image_7' => $rental->image_7,
                    'rental_description_1' => $rental->rental_description_1,
                    'rental_description_2' => $rental->rental_description_2,
                    'rental_description_3' => $rental->rental_description_3,
                    'rental_description_4' => $rental->rental_description_4,
                    'rental_description_5' => $rental->rental_description_5,
                    'rental_description_6' => $rental->rental_description_6,
                    'rental_description_7' => $rental->rental_description_7,
                    'rental_description_8' => $rental->rental_description_8,
                    'rental_more_info' => $rental->rental_more_info,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                ];
            });

            return response()->json([
                'data' => $rentalData,
                'current_page' => $rentals->currentPage(),
                'last_page' => $rentals->lastPage()
            ]);
        }
        $rentals = RentalResource::collection(Rental::latest()->with('rentalreviews')->paginate(20));

        $rentalData = $rentals->map(function ($rental) {
            $ratings = $rental->rentalReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;

            return [
                'id' => $rental->id,
                'user_id' => $rental->user_id,
                'slug' => $rental->slug,
                'contact_information' => $rental->contact_information,
                'rental_name' => $rental->rental_name,
                'rental_category' => $rental->rental_category,
                'no_of_rooms' => $rental->no_of_rooms,
                'maps' => $rental->maps,
                'rental_area' => $rental->rental_area,
                'vacancy_status' => $rental->vacancy_status,
                'rental_price' => $rental->rental_price,
                'pay_per' => $rental->pay_per,
                'image_1' => $rental->image_1,
                'image_2' => $rental->image_2,
                'image_3' => $rental->image_3,
                'image_4' => $rental->image_4,
                'image_5' => $rental->image_5,
                'image_6' => $rental->image_6,
                'image_7' => $rental->image_7,
                'rental_description_1' => $rental->rental_description_1,
                'rental_description_2' => $rental->rental_description_2,
                'rental_description_3' => $rental->rental_description_3,
                'rental_description_4' => $rental->rental_description_4,
                'rental_description_5' => $rental->rental_description_5,
                'rental_description_6' => $rental->rental_description_6,
                'rental_description_7' => $rental->rental_description_7,
                'rental_description_8' => $rental->rental_description_8,
                'rental_more_info' => $rental->rental_more_info,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
            ];
        });

        return response()->json([
            'data' => $rentalData,
            'current_page' => $rentals->currentPage(),
            'last_page' => $rentals->lastPage()
        ]);

        //return RentalResource::collection(Rental::latest()->paginate(10));
    }

    public function page(Request $request)
    {
        if ($request->search) {
            return  RentalResource::collection(Rental::where('rental_name', 'like', '%' . $request->search . '%')
            ->orWhere('contact_information', 'like', '%' . $request->search . '%')
            ->orWhere('rental_category', 'like', '%' . $request->search . '%')
            ->orWhere('no_of_rooms', 'like', '%' . $request->search . '%')
            ->orWhere('vacancy_status', 'like', '%' . $request->search . '%')
            ->orWhere('rental_price', 'like', '%' . $request->search . '%')
            ->orWhere('pay_per', 'like', '%' . $request->search . '%')
            ->orWhere('rental_area', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_1', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_2', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_3', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_4', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_5', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_6', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_7', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_8', 'like', '%' . $request->search . '%')
            ->orWhere('rental_more_info', 'like', '%' . $request->search . '%')
            ->latest()->paginate(1)->withQueryString()
            );
        }

        return RentalResource::collection(Rental::latest()->paginate(10));
    }

    public function similarProds(Request $request)
    {
        $rentals = RentalResource::collection(Rental::latest()->with('rentalreviews')->paginate(6));

        $rentalData = $rentals->map(function ($rental) {
            $ratings = $rental->rentalReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;

            return [
                'id' => $rental->id,
                'user_id' => $rental->user_id,
                'slug' => $rental->slug,
                'contact_information' => $rental->contact_information,
                'rental_name' => $rental->rental_name,
                'rental_category' => $rental->rental_category,
                'no_of_rooms' => $rental->no_of_rooms,
                'maps' => $rental->maps,
                'rental_area' => $rental->rental_area,
                'vacancy_status' => $rental->vacancy_status,
                'rental_price' => $rental->rental_price,
                'pay_per' => $rental->pay_per,
                'image_1' => $rental->image_1,
                'image_2' => $rental->image_2,
                'image_3' => $rental->image_3,
                'image_4' => $rental->image_4,
                'image_5' => $rental->image_5,
                'image_6' => $rental->image_6,
                'image_7' => $rental->image_7,
                'rental_description_1' => $rental->rental_description_1,
                'rental_description_2' => $rental->rental_description_2,
                'rental_description_3' => $rental->rental_description_3,
                'rental_description_4' => $rental->rental_description_4,
                'rental_description_5' => $rental->rental_description_5,
                'rental_description_6' => $rental->rental_description_6,
                'rental_description_7' => $rental->rental_description_7,
                'rental_description_8' => $rental->rental_description_8,
                'rental_more_info' => $rental->rental_more_info,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
            ];
        });

        return response()->json([
            'data' => $rentalData,
            'current_page' => $rentals->currentPage(),
            'last_page' => $rentals->lastPage()
        ]);
    }

    public function home(Request $request)
    {
        if ($request->search) {
            $rentals = RentalResource::collection(Rental::where('rental_name', 'like', '%' . $request->search . '%')
            ->orWhere('contact_information', 'like', '%' . $request->search . '%')
            ->orWhere('rental_category', 'like', '%' . $request->search . '%')
            ->orWhere('no_of_rooms', 'like', '%' . $request->search . '%')
            ->orWhere('vacancy_status', 'like', '%' . $request->search . '%')
            ->orWhere('rental_price', 'like', '%' . $request->search . '%')
            ->orWhere('pay_per', 'like', '%' . $request->search . '%')
            ->orWhere('rental_area', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_1', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_2', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_3', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_4', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_5', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_6', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_7', 'like', '%' . $request->search . '%')
            ->orWhere('rental_description_8', 'like', '%' . $request->search . '%')
            ->orWhere('rental_more_info', 'like', '%' . $request->search . '%')
            ->latest()->with('rentalreviews')->paginate(10)->withQueryString());

            $rentalData = $rentals->map(function ($rental) {
                $ratings = $rental->rentalReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;
                
                return [
                    'id' => $rental->id,
                    'user_id' => $rental->user_id,
                    'slug' => $rental->slug,
                    'contact_information' => $rental->contact_information,
                    'rental_name' => $rental->rental_name,
                    'rental_category' => $rental->rental_category,
                    'no_of_rooms' => $rental->no_of_rooms,
                    'maps' => $rental->maps,
                    'rental_area' => $rental->rental_area,
                    'vacancy_status' => $rental->vacancy_status,
                    'rental_price' => $rental->rental_price,
                    'pay_per' => $rental->pay_per,
                    'image_1' => $rental->image_1,
                    'image_2' => $rental->image_2,
                    'image_3' => $rental->image_3,
                    'image_4' => $rental->image_4,
                    'image_5' => $rental->image_5,
                    'image_6' => $rental->image_6,
                    'image_7' => $rental->image_7,                
                    'rental_description_1' => $rental->rental_description_1,
                    'rental_description_2' => $rental->rental_description_2,
                    'rental_description_3' => $rental->rental_description_3,
                    'rental_description_4' => $rental->rental_description_4,
                    'rental_description_5' => $rental->rental_description_5,
                    'rental_description_6' => $rental->rental_description_6,
                    'rental_description_7' => $rental->rental_description_7,
                    'rental_description_8' => $rental->rental_description_8,
                    'rental_more_info' => $rental->rental_more_info,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                ];
            });

            return response()->json([
                'data' => $rentalData,
                'current_page' => $rentals->currentPage(),
                'last_page' => $rentals->lastPage()
            ]);
        }
        $rentals = RentalResource::collection(Rental::latest()->with('rentalreviews')->paginate(12));

        $rentalData = $rentals->map(function ($rental) {
            $ratings = $rental->rentalReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;
           
            return [
                'id' => $rental->id,
                    'user_id' => $rental->user_id,
                    'slug' => $rental->slug,
                    'contact_information' => $rental->contact_information,
                    'rental_name' => $rental->rental_name,
                    'rental_category' => $rental->rental_category,
                    'no_of_rooms' => $rental->no_of_rooms,
                    'maps' => $rental->maps,
                    'rental_area' => $rental->rental_area,
                    'vacancy_status' => $rental->vacancy_status,
                    'rental_price' => $rental->rental_price,
                    'pay_per' => $rental->pay_per,
                    'image_1' => $rental->image_1,
                    'image_2' => $rental->image_2,
                    'image_3' => $rental->image_3,
                    'image_4' => $rental->image_4,
                    'image_5' => $rental->image_5,
                    'image_6' => $rental->image_6,
                    'image_7' => $rental->image_7,                
                    'rental_description_1' => $rental->rental_description_1,
                    'rental_description_2' => $rental->rental_description_2,
                    'rental_description_3' => $rental->rental_description_3,
                    'rental_description_4' => $rental->rental_description_4,
                    'rental_description_5' => $rental->rental_description_5,
                    'rental_description_6' => $rental->rental_description_6,
                    'rental_description_7' => $rental->rental_description_7,
                    'rental_description_8' => $rental->rental_description_8,
                    'rental_more_info' => $rental->rental_more_info,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
            ];
        });

        return response()->json([
            'data' => $rentalData,
            'current_page' => $rentals->currentPage(),
            'last_page' => $rentals->lastPage()
        ]);
    }

    public function viewRental($id)
    {
        $rental = Rental::find($id);
        session()->push('viewed_rentals', $id);
        return view('rental', ['rental' => $rental]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'nullable | image',
            'rental_name' => 'required',
            'rental_price' => 'required',
        ]);
        

        if (!Rental::count()) {
            $rentalId = 1;
        } else {
            $rentalId = Rental::latest()->first()->id + 1;
        }

        $rental = new Rental();

        $rental_name = $request->rental_name;
        $user_id = auth()->user()->id;
        $slug = Str::slug($rental_name, '-') . '-' . $rentalId;
        $rental_price = $request->input('rental_price');
        $rental_category = $request->input('rental_category');
        $contact_information = $request->input('contact_information');
        $no_of_rooms = $request->input('no_of_rooms');
        $maps = $request->input('maps');
        $rental_area = $request->input('rental_area');
        $vacancy_status = $request->input('vacancy_status');
        $pay_per = $request->input('pay_per');
        $rental_description_1 = $request->input('rental_description_1');
        $rental_description_2 = $request->input('rental_description_2');
        $rental_description_3 = $request->input('rental_description_3');
        $rental_description_4 = $request->input('rental_description_4');
        $rental_description_5 = $request->input('rental_description_5');
        $rental_description_6 = $request->input('rental_description_6');
        $rental_description_7 = $request->input('rental_description_7');
        $rental_description_8 = $request->input('rental_description_8');
        $rental_more_info = $request->input('rental_more_info');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image1->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $rental->image_1 = $image_1;
        }


        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image2->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $rental->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image3->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $rental->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image4->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $rental->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image5->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $rental->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            $image6 = $request->file('file6');
            $image_6 = $request->file('file6')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image6->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);
            $rental->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            $image7 = $request->file('file7');
            $image_7 = $request->file('file7')->store('');
            $destinationPath = public_path('img/house');
            $img = Image::make($image7->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);
            $rental->image_7 = $image_7;
        }

        // create and save rental

        $rental->rental_name = $rental_name;
        $rental->slug = $slug;
        $rental->user_id = $user_id;
        $rental->rental_price = $rental_price;
        $rental->rental_category = $rental_category;
        $rental->contact_information = $contact_information;
        $rental->no_of_rooms = $no_of_rooms;
        $rental->maps = $maps;
        $rental->rental_area = $rental_area;
        $rental->vacancy_status = $vacancy_status;
        $rental->pay_per = $pay_per;
        $rental->rental_description_1 = $rental_description_1;
        $rental->rental_description_2 = $rental_description_2;
        $rental->rental_description_3 = $rental_description_3;
        $rental->rental_description_4 = $rental_description_4;
        $rental->rental_description_5 = $rental_description_5;
        $rental->rental_description_6 = $rental_description_6;
        $rental->rental_description_7 = $rental_description_7;
        $rental->rental_description_8 = $rental_description_8;
        $rental->rental_more_info = $rental_more_info;
        $rental->save();
    }

    public function show(Rental $rental)
    {
        //return new RentalResource($rental);

        $booked = false;
        if (auth()->user()) {
            $user = auth()->user();
            $booked = RentalBooking::where('senderId', $user->id)->where('rentalId', $rental->id)->exists();
        }
        $rentals = Rental::find($rental->id);
        $data = [
            "data" => $rentals,
            "booked" => $booked,
            "avg_rate" => $rentals->average_rating,
            "comment_count" => $rentals->count_comment,
        ];


        return response()->json($data);
    }

    public function update(Request $request, Rental $rental)
    {
        if (auth()->user()->id != $rental->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        $request->validate([
            'rental_name' => 'required',
            'file' => 'nullable | image',
        ]);


        if ($request->file('file1')) {
            File::delete($rental->image_1);

            $image = $request->file('file1');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_1 = $request->file('file1')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);

            $rental->image_1 = $image_1;
        }

        if ($request->file('file2')) {
            File::delete($rental->image_2);

            $image = $request->file('file2');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_2 = $request->file('file2')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);

            $rental->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            File::delete($rental->image_3);

            $image = $request->file('file3');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_3 = $request->file('file3')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);

            $rental->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            File::delete($rental->image_4);

            $image = $request->file('file4');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_4 = $request->file('file4')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);

            $rental->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            File::delete($rental->image_5);

            $image = $request->file('file5');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_5 = $request->file('file5')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);

            $rental->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            File::delete($rental->image_6);

            $image = $request->file('file6');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_6 = $request->file('file6')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);

            $rental->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            File::delete($rental->image_7);

            $image = $request->file('file7');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_7 = $request->file('file7')->store('');

            $destinationPath = public_path('img/house');
            $img = Image::make($image->getRealPath());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);

            $rental->image_7 = $image_7;
        }

        // create and save post


        if ($request->rental_name) {
            $rental_name = $request->rental_name;
            $rental->rental_name = $rental_name;
        }

        if ($request->input('rental_price')) {
            $rental_price = $request->input('rental_price');
            $rental->rental_price = $rental_price;
        }

        if ($request->input('rental_category')) {
            $rental_category = $request->input('rental_category');
            $rental->rental_category = $rental_category;
        }

        if ($request->input('contact_information')) {
            $contact_information = $request->input('contact_information');
            $rental->contact_information = $contact_information;
        }

        if ($request->input('no_of_rooms')) {
            $no_of_rooms = $request->input('no_of_rooms');
            $rental->no_of_rooms = $no_of_rooms;
        }

        if ($request->input('maps')) {
            $maps = $request->input('maps');
            $rental->maps = $maps;
        }

        if ($request->input('rental_area')) {
            $rental_area = $request->input('rental_area');
            $rental->rental_area = $rental_area;
        }

        if ($request->input('vacancy_status')) {
            $vacancy_status = $request->input('vacancy_status');
            $rental->vacancy_status = $vacancy_status;
        }

        if ($request->input('pay_per')) {
            $pay_per = $request->input('pay_per');
            $rental->pay_per = $pay_per;
        }

        if ($request->input('rental_description_1')) {
            $rental_description_1 = $request->input('rental_description_1');
            $rental->rental_description_1 = $rental_description_1;
        }

        if ($request->input('rental_description_2')) {
            $rental_description_2 = $request->input('rental_description_2');
            $rental->rental_description_2 = $rental_description_2;
        }

        if ($request->input('rental_description_3')) {
            $rental_description_3 = $request->input('rental_description_3');
            $rental->rental_description_3 = $rental_description_3;
        }

        if ($request->input('rental_description_4')) {
            $rental_description_4 = $request->input('rental_description_4');
            $rental->rental_description_4 = $rental_description_4;
        }

        if ($request->input('rental_description_5')) {
            $rental_description_5 = $request->input('rental_description_5');
            $rental->rental_description_5 = $rental_description_5;
        }

        if ($request->input('rental_description_6')) {
            $rental_description_6 = $request->input('rental_description_6');
            $rental->rental_description_6 = $rental_description_6;
        }

        if ($request->input('rental_description_7')) {
            $rental_description_7 = $request->input('rental_description_7');
            $rental->rental_description_7 = $rental_description_7;
        }

        if ($request->input('rental_description_8')) {
            $rental_description_8 = $request->input('rental_description_8');
            $rental->rental_description_8 = $rental_description_8;
        }

        if ($request->input('rental_more_info')) {
            $rental_more_info = $request->input('rental_more_info');
            $rental->rental_more_info = $rental_more_info;
        }

        $rental->save();
    }

    public function destroy(Rental $rental)
    {
        if (auth()->user()->id != $rental->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }

        return $rental->delete();
    }
}
