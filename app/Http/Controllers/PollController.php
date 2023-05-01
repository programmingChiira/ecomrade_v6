<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollResource;
use App\Models\PollCategory;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollReview;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $polls = PollResource::collection(Poll::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('argument', 'like', '%' . $request->search . '%')
                ->orWhere('option_1', 'like', '%' . $request->search . '%')
                ->orWhere('option_2', 'like', '%' . $request->search . '%')
                ->orWhere('option_3', 'like', '%' . $request->search . '%')
                ->orWhere('option_4', 'like', '%' . $request->search . '%')
                ->orWhere('option_5', 'like', '%' . $request->search . '%')
                ->orWhere('option_6', 'like', '%' . $request->search . '%')
                ->orWhere('option_7', 'like', '%' . $request->search . '%')
                ->orWhere('option_8', 'like', '%' . $request->search . '%')
                ->orWhere('option_9', 'like', '%' . $request->search . '%')
                ->orWhere('option_10', 'like', '%' . $request->search . '%')
                ->latest()->with('pollvotes')->paginate(10)->withQueryString());

            $pollData = $polls->map(function ($poll) {
                $votes = $poll->pollVotes;
                $count = $votes->count();

                $voters = $poll->pollvotesid;
                $counter = $voters->count();

                return [
                    'id' => $poll->id,
                    'user_id' => $poll->user_id,
                    'slug' => $poll->slug,
                    'contact' => $poll->contact,
                    'user_name' => $poll->user_name,
                    'title' => $poll->title,
                    'argument' => $poll->argument,
                    'show_owner' => $poll->show_owner,
                    'owner_slug' => $poll->owner_slug,
                    'image_1' => $poll->image_1,
                    'image_2' => $poll->image_2,
                    'image_3' => $poll->image_3,
                    'image_4' => $poll->image_4,
                    'image_5' => $poll->image_5,
                    'image_6' => $poll->image_6,
                    'image_7' => $poll->image_7,
                    'image_8' => $poll->image_8,
                    'image_9' => $poll->image_9,
                    'image_10' => $poll->image_10,
                    'option_1' => $poll->option_1,
                    'option_2' => $poll->option_2,
                    'option_3' => $poll->option_3,
                    'option_4' => $poll->option_4,
                    'option_5' => $poll->option_5,
                    'option_6' => $poll->option_6,
                    'option_7' => $poll->option_7,
                    'option_8' => $poll->option_8,
                    'option_9' => $poll->option_9,
                    'option_10' => $poll->option_10,
                    'club_id' => $poll->club_id,
                    'vote_count' => $count,
                    'voter_id_count' => $counter,
                    'option_1_count' => $votes->where('vote', $poll->option_1)->count(),
                    'option_2_count' => $votes->where('vote', $poll->option_2)->count(),
                    'option_3_count' => $votes->where('vote', $poll->option_3)->count(),
                    'option_4_count' => $votes->where('vote', $poll->option_4)->count(),
                    'option_5_count' => $votes->where('vote', $poll->option_5)->count(),
                    'option_6_count' => $votes->where('vote', $poll->option_6)->count(),
                    'option_7_count' => $votes->where('vote', $poll->option_7)->count(),
                    'option_8_count' => $votes->where('vote', $poll->option_8)->count(),
                    'option_9_count' => $votes->where('vote', $poll->option_9)->count(),
                    'option_10_count' => $votes->where('vote', $poll->option_10)->count(),
                ];
            });

            return response()->json([
                'data' => $pollData,
                'current_page' => $polls->currentPage(),
                'last_page' => $polls->lastPage()
            ]);
        }

        $polls = PollResource::collection(Poll::latest()->with('pollvotes')->with('pollvotesid')->paginate(20));

        $pollData = $polls->map(function ($poll) {
            $votes = $poll->pollVotes;
            $count = $votes->count();

            $voters = $poll->pollvotesid;
            $counter = $voters->count();


            return [
                'id' => $poll->id,
                'user_id' => $poll->user_id,
                'slug' => $poll->slug,
                'contact' => $poll->contact,
                'user_name' => $poll->user_name,
                'title' => $poll->title,
                'argument' => $poll->argument,
                'show_owner' => $poll->show_owner,
                'owner_slug' => $poll->owner_slug,
                'image_1' => $poll->image_1,
                'image_2' => $poll->image_2,
                'image_3' => $poll->image_3,
                'image_4' => $poll->image_4,
                'image_5' => $poll->image_5,
                'image_6' => $poll->image_6,
                'image_7' => $poll->image_7,
                'image_8' => $poll->image_8,
                'image_9' => $poll->image_9,
                'image_10' => $poll->image_10,
                'option_1' => $poll->option_1,
                'option_2' => $poll->option_2,
                'option_3' => $poll->option_3,
                'option_4' => $poll->option_4,
                'option_5' => $poll->option_5,
                'option_6' => $poll->option_6,
                'option_7' => $poll->option_7,
                'option_8' => $poll->option_8,
                'option_9' => $poll->option_9,
                'option_10' => $poll->option_10,
                'club_id' => $poll->club_id,
                'vote_count' => $count,
                'voter_id_count' => $counter,
                'option_1_count' => $votes->where('vote', $poll->option_1)->count(),
                'option_2_count' => $votes->where('vote', $poll->option_2)->count(),
                'option_3_count' => $votes->where('vote', $poll->option_3)->count(),
                'option_4_count' => $votes->where('vote', $poll->option_4)->count(),
                'option_5_count' => $votes->where('vote', $poll->option_5)->count(),
                'option_6_count' => $votes->where('vote', $poll->option_6)->count(),
                'option_7_count' => $votes->where('vote', $poll->option_7)->count(),
                'option_8_count' => $votes->where('vote', $poll->option_8)->count(),
                'option_9_count' => $votes->where('vote', $poll->option_9)->count(),
                'option_10_count' => $votes->where('vote', $poll->option_10)->count(),
            ];
        });

        return response()->json([
            'data' => $pollData,
            'current_page' => $polls->currentPage(),
            'last_page' => $polls->lastPage()
        ]);
    }
    public function home(Request $request)
    {
        if ($request->search) {
            $polls = PollResource::collection(Poll::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('user_name', 'like', '%' . $request->search . '%')
                ->orWhere('argument', 'like', '%' . $request->search . '%')
                ->orWhere('product_sub_category', 'like', '%' . $request->search . '%')
                ->orWhere('option_1', 'like', '%' . $request->search . '%')
                ->orWhere('option_2', 'like', '%' . $request->search . '%')
                ->orWhere('option_3', 'like', '%' . $request->search . '%')
                ->orWhere('option_4', 'like', '%' . $request->search . '%')
                ->orWhere('option_5', 'like', '%' . $request->search . '%')
                ->orWhere('option_6', 'like', '%' . $request->search . '%')
                ->orWhere('option_7', 'like', '%' . $request->search . '%')
                ->orWhere('option_8', 'like', '%' . $request->search . '%')
                ->orWhere('option_9', 'like', '%' . $request->search . '%')
                ->orWhere('option_10', 'like', '%' . $request->search . '%')
                ->latest()->with('pollvotes')->paginate(10)->withQueryString());

            $pollData = $polls->map(function ($poll) {
                $votes = $poll->pollVotes;
                $count = $votes->count();

                $optionVotes = $poll->pollVotes;
                $optionCount = $optionVotes->count();

                return [
                    'id' => $poll->id,
                    'user_id' => $poll->user_id,
                    'slug' => $poll->slug,
                    'contact' => $poll->contact,
                    'user_name' => $poll->user_name,
                    'title' => $poll->title,
                    'argument' => $poll->argument,
                    'show_owner' => $poll->show_owner,
                    'owner_slug' => $poll->owner_slug,
                    'image_1' => $poll->image_1,
                    'image_2' => $poll->image_2,
                    'image_3' => $poll->image_3,
                    'image_4' => $poll->image_4,
                    'image_5' => $poll->image_5,
                    'image_6' => $poll->image_6,
                    'image_7' => $poll->image_7,
                    'image_8' => $poll->image_8,
                    'image_9' => $poll->image_9,
                    'image_10' => $poll->image_10,
                    'option_1' => $poll->option_1,
                    'option_2' => $poll->option_2,
                    'option_3' => $poll->option_3,
                    'option_4' => $poll->option_4,
                    'option_5' => $poll->option_5,
                    'option_6' => $poll->option_6,
                    'option_7' => $poll->option_7,
                    'option_8' => $poll->option_8,
                    'option_9' => $poll->option_9,
                    'option_10' => $poll->option_10,
                    'club_id' => $poll->club_id,
                    'vote_count' => $count,
                    'option_count' => $optionCount,
                ];
            });

            return response()->json([
                'data' => $pollData,
                'current_page' => $polls->currentPage(),
                'last_page' => $polls->lastPage()
            ]);
        }

        $polls = PollResource::collection(Poll::latest()->with('pollvotes')->paginate(20));

        $pollData = $polls->map(function ($poll) {
            $votes = $poll->pollVotes;
            $count = $votes->count();

            $optionVotes = $poll->pollVotes;
            $optionCount = $optionVotes->count();

            return [
                'id' => $poll->id,
                'user_id' => $poll->user_id,
                'slug' => $poll->slug,
                'contact' => $poll->contact,
                'user_name' => $poll->user_name,
                'title' => $poll->title,
                'argument' => $poll->argument,
                'show_owner' => $poll->show_owner,
                'owner_slug' => $poll->owner_slug,
                'image_1' => $poll->image_1,
                'image_2' => $poll->image_2,
                'image_3' => $poll->image_3,
                'image_4' => $poll->image_4,
                'image_5' => $poll->image_5,
                'image_6' => $poll->image_6,
                'image_7' => $poll->image_7,
                'image_8' => $poll->image_8,
                'image_9' => $poll->image_9,
                'image_10' => $poll->image_10,
                'option_1' => $poll->option_1,
                'option_2' => $poll->option_2,
                'option_3' => $poll->option_3,
                'option_4' => $poll->option_4,
                'option_5' => $poll->option_5,
                'option_6' => $poll->option_6,
                'option_7' => $poll->option_7,
                'option_8' => $poll->option_8,
                'option_9' => $poll->option_9,
                'option_10' => $poll->option_10,
                'club_id' => $poll->club_id,
                'vote_count' => $count,
                'option_count' => $optionCount,
            ];
        });


        return response()->json([
            'data' => $pollData,
            'current_page' => $polls->currentPage(),
            'last_page' => $polls->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'nullable | image',
            'title' => 'required',
            'argument' => 'required',
        ]);
        $title = $request->title;

        if (!Poll::count()) {
            $pollId = 1;
        } else {
            $pollId = Poll::latest()->first()->id + 1;
        }

        $poll = new Poll();

        $slug = Str::slug($title, '-') . '-' . $pollId;
        $user_id = auth()->user()->id;
        $contact = $request->input('contact');
        $user_name = auth()->user()->name;
        $argument = $request->input('argument');
        $show_owner = $request->input('show_owner');
        $owner_slug = auth()->user()->slug;
        $image_1 = $request->input('image_1');
        $image_2 = $request->input('image_2');
        $image_3 = $request->input('image_3');
        $image_4 = $request->input('image_4');
        $image_5 = $request->input('image_5');
        $image_6 = $request->input('image_6');
        $image_7 = $request->input('image_7');
        $image_8 = $request->input('image_8');
        $image_9 = $request->input('image_9');
        $image_10 = $request->input('image_10');
        $option_1 = $request->input('option_1');
        $option_2 = $request->input('option_2');
        $option_3 = $request->input('option_3');
        $option_4 = $request->input('option_4');
        $option_5 = $request->input('option_5');
        $option_6 = $request->input('option_6');
        $option_7 = $request->input('option_7');
        $option_8 = $request->input('option_8');
        $option_9 = $request->input('option_9');
        $option_10 = $request->input('option_10');
        $club_id = $request->input('club_id');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $poll->image_1 = $image_1;
        }


        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $poll->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $poll->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $poll->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $poll->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            $image6 = $request->file('file6');
            $image_6 = $request->file('file6')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image6->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);
            $poll->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            $image7 = $request->file('file7');
            $image_7 = $request->file('file7')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image7->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);
            $poll->image_7 = $image_7;
        }

        if ($request->file('file8')) {
            $image8 = $request->file('file8');
            $image_8 = $request->file('file8')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image8->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_8);
            $poll->image_8 = $image_8;
        }

        if ($request->file('file9')) {
            $image9 = $request->file('file9');
            $image_9 = $request->file('file9')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image9->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_9);
            $poll->image_9 = $image_9;
        }

        if ($request->file('file10')) {
            $image10 = $request->file('file10');
            $image_10 = $request->file('file10')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image10->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_10);
            $poll->image_10 = $image_10;
        }

        // create and save poll

        $poll->title = $title;
        $poll->slug = $slug;
        $poll->user_id = $user_id;


        $poll->contact = $contact;
        $poll->user_name = $user_name;
        $poll->argument = $argument;
        $poll->show_owner = $show_owner;
        $poll->owner_slug = $owner_slug;
        $poll->option_1 = $option_1;
        $poll->option_1 = $option_1;
        $poll->option_2 = $option_2;
        $poll->option_3 = $option_3;
        $poll->option_4 = $option_4;
        $poll->option_5 = $option_5;
        $poll->option_6 = $option_6;
        $poll->option_7 = $option_7;
        $poll->option_8 = $option_8;
        $poll->option_9 = $option_9;
        $poll->option_10 = $option_10;
        $poll->club_id = $club_id;
        $poll->save();
    }


    public function club_store(Request $request)
    {
        $request->validate([
            'file' => 'nullable | image',
            'title' => 'required',
            'argument' => 'required',
        ]);
        $title = $request->title;

        if (!Poll::count()) {
            $pollId = 1;
        } else {
            $pollId = Poll::latest()->first()->id + 1;
        }

        $poll = new Poll();

        $slug = Str::slug($title, '-') . '-' . $pollId;
        $user_id = auth()->user()->id;
        $contact = $request->input('contact');
        $user_name = $request->input('club_name');;
        $argument = $request->input('argument');
        $show_owner = $request->input('show_owner');
        $owner_slug = auth()->user()->slug;
        $image_1 = $request->input('image_1');
        $image_2 = $request->input('image_2');
        $image_3 = $request->input('image_3');
        $image_4 = $request->input('image_4');
        $image_5 = $request->input('image_5');
        $image_6 = $request->input('image_6');
        $image_7 = $request->input('image_7');
        $image_8 = $request->input('image_8');
        $image_9 = $request->input('image_9');
        $image_10 = $request->input('image_10');
        $option_1 = $request->input('option_1');
        $option_2 = $request->input('option_2');
        $option_3 = $request->input('option_3');
        $option_4 = $request->input('option_4');
        $option_5 = $request->input('option_5');
        $option_6 = $request->input('option_6');
        $option_7 = $request->input('option_7');
        $option_8 = $request->input('option_8');
        $option_9 = $request->input('option_9');
        $option_10 = $request->input('option_10');
        $club_id = $request->input('club_id');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $poll->image_1 = $image_1;
        }


        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $poll->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $poll->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $poll->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $poll->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            $image6 = $request->file('file6');
            $image_6 = $request->file('file6')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image6->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);
            $poll->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            $image7 = $request->file('file7');
            $image_7 = $request->file('file7')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image7->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);
            $poll->image_7 = $image_7;
        }

        if ($request->file('file8')) {
            $image8 = $request->file('file8');
            $image_8 = $request->file('file8')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image8->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_8);
            $poll->image_8 = $image_8;
        }

        if ($request->file('file9')) {
            $image9 = $request->file('file9');
            $image_9 = $request->file('file9')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image9->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_9);
            $poll->image_9 = $image_9;
        }

        if ($request->file('file10')) {
            $image10 = $request->file('file10');
            $image_10 = $request->file('file10')->store('');
            $destinationPath = public_path('img/poll');
            $img = Image::make($image10->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_10);
            $poll->image_10 = $image_10;
        }

        // create and save poll

        $poll->title = $title;
        $poll->slug = $slug;
        $poll->user_id = $user_id;


        $poll->contact = $contact;
        $poll->user_name = $user_name;
        $poll->argument = $argument;
        $poll->show_owner = $show_owner;
        $poll->owner_slug = $owner_slug;
        $poll->option_1 = $option_1;
        $poll->option_1 = $option_1;
        $poll->option_2 = $option_2;
        $poll->option_3 = $option_3;
        $poll->option_4 = $option_4;
        $poll->option_5 = $option_5;
        $poll->option_6 = $option_6;
        $poll->option_7 = $option_7;
        $poll->option_8 = $option_8;
        $poll->option_9 = $option_9;
        $poll->option_10 = $option_10;
        $poll->club_id = $club_id;
        $poll->save();
    }

    // public function show(Poll $poll)
    // {
    //     $polls = Poll::find($poll->id);
    //     $data = [
    //         "data" => $polls,
    //     ];
    //     return response()->json($data);
    // }
    
    public function show(Poll $poll)
    {
        $votes = $poll->pollVotes;
        $count = $votes->count();
        $voters = $poll->pollvotesid;
        $counter = $voters->count();

        $pollData = [
            'id' => $poll->id,
            'user_id' => $poll->user_id,
            'slug' => $poll->slug,
            'contact' => $poll->contact,
            'user_name' => $poll->user_name,
            'title' => $poll->title,
            'argument' => $poll->argument,
            'show_owner' => $poll->show_owner,
            'owner_slug' => $poll->owner_slug,
            'image_1' => $poll->image_1,
            'image_2' => $poll->image_2,
            'image_3' => $poll->image_3,
            'image_4' => $poll->image_4,
            'image_5' => $poll->image_5,
            'image_6' => $poll->image_6,
            'image_7' => $poll->image_7,
            'image_8' => $poll->image_8,
            'image_9' => $poll->image_9,
            'image_10' => $poll->image_10,
            'option_1' => $poll->option_1,
            'option_2' => $poll->option_2,
            'option_3' => $poll->option_3,
            'option_4' => $poll->option_4,
            'option_5' => $poll->option_5,
            'option_6' => $poll->option_6,
            'option_7' => $poll->option_7,
            'option_8' => $poll->option_8,
            'option_9' => $poll->option_9,
            'option_10' => $poll->option_10,
            'club_id' => $poll->club_id,
            'vote_count' => $count,
            'voter_id_count' => $counter,
            'option_1_count' => $votes->where('vote', $poll->option_1)->count(),
            'option_2_count' => $votes->where('vote', $poll->option_2)->count(),
            'option_3_count' => $votes->where('vote', $poll->option_3)->count(),
            'option_4_count' => $votes->where('vote', $poll->option_4)->count(),
            'option_5_count' => $votes->where('vote', $poll->option_5)->count(),
            'option_6_count' => $votes->where('vote', $poll->option_6)->count(),
            'option_7_count' => $votes->where('vote', $poll->option_7)->count(),
            'option_8_count' => $votes->where('vote', $poll->option_8)->count(),
            'option_9_count' => $votes->where('vote', $poll->option_9)->count(),
            'option_10_count' => $votes->where('vote', $poll->option_10)->count(),
        ];

        return response()->json([
            'data' => $pollData,
        ]);
    }

    public function club_show(Poll $poll)
    {
        //return new PollResource($poll);

        $polls = Poll::find($poll->id);
        $data = [
            "data" => $polls
        ];

        return response()->json($data);
    }


    public function update(Request $request, Poll $poll)
    {
        if (auth()->user()->id != $poll->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        $request->validate([
            'title' => 'required',
            'file' => 'nullable | image',
        ]);


        if ($request->file('file1')) {
            File::delete($poll->image_1);

            $image = $request->file('file1');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_1 = $request->file('file1')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);

            $poll->image_1 = $image_1;
        }

        if ($request->file('file2')) {
            File::delete($poll->image_2);

            $image = $request->file('file2');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_2 = $request->file('file2')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);

            $poll->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            File::delete($poll->image_3);

            $image = $request->file('file3');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_3 = $request->file('file3')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);

            $poll->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            File::delete($poll->image_4);

            $image = $request->file('file4');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_4 = $request->file('file4')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);

            $poll->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            File::delete($poll->image_5);

            $image = $request->file('file5');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_5 = $request->file('file5')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);

            $poll->image_5 = $image_5;
        }

        if ($request->file('file6')) {
            File::delete($poll->image_6);

            $image = $request->file('file6');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_6 = $request->file('file6')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_6);

            $poll->image_6 = $image_6;
        }

        if ($request->file('file7')) {
            File::delete($poll->image_7);

            $image = $request->file('file7');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_7 = $request->file('file7')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_7);

            $poll->image_7 = $image_7;
        }

        if ($request->file('file8')) {
            File::delete($poll->image_8);

            $image = $request->file('file8');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_8 = $request->file('file8')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_8);

            $poll->image_8 = $image_8;
        }

        if ($request->file('file9')) {
            File::delete($poll->image_9);

            $image = $request->file('file9');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_9 = $request->file('file9')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_9);

            $poll->image_9 = $image_9;
        }

        if ($request->file('file10')) {
            File::delete($poll->image_10);

            $image = $request->file('file10');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image_10 = $request->file('file10')->store('');

            $destinationPath = public_path('img/poll');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_10);

            $poll->image_10 = $image_10;
        }

        // create and save post


        if ($request->title) {
            $title = $request->title;
            $poll->title = $title;
        }

        if ($request->input('argument')) {
            $argument = $request->input('argument');
            $poll->argument = $argument;
        }

        if ($request->input('contact')) {
            $contact = $request->input('contact');
            $poll->contact = $contact;
        }

        if ($request->input('show_owner')) {
            $show_owner = $request->input('show_owner');
            $poll->show_owner = $show_owner;
        }

        if ($request->input('option_1')) {
            $option_1 = $request->input('option_1');
            $poll->option_1 = $option_1;
        }

        if ($request->input('option_2')) {
            $option_2 = $request->input('option_2');
            $poll->option_2 = $option_2;
        }

        if ($request->input('option_3')) {
            $option_3 = $request->input('option_3');
            $poll->option_3 = $option_3;
        }

        if ($request->input('option_4')) {
            $option_4 = $request->input('option_4');
            $poll->option_4 = $option_4;
        }

        if ($request->input('option_5')) {
            $option_5 = $request->input('option_5');
            $poll->option_5 = $option_5;
        }

        if ($request->input('option_6')) {
            $option_6 = $request->input('option_6');
            $poll->option_6 = $option_6;
        }

        if ($request->input('option_7')) {
            $option_7 = $request->input('option_7');
            $poll->option_7 = $option_7;
        }

        if ($request->input('option_8')) {
            $option_8 = $request->input('option_8');
            $poll->option_8 = $option_8;
        }

        if ($request->input('option_9')) {
            $option_9 = $request->input('option_9');
            $poll->option_9 = $option_9;
        }

        if ($request->input('option_10')) {
            $option_10 = $request->input('option_10');
            $poll->option_10 = $option_10;
        }
        $poll->save();
    }

    public function destroy(Poll $poll)
    {
        if (auth()->user()->id != $poll->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        return $poll->delete();
    }
}
