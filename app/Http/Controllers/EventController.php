<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventBooking;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $events = EventResource::collection(Event::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('requirement_1', 'like', '%' . $request->search . '%')
                ->orWhere('requirement_2', 'like', '%' . $request->search . '%')
                ->orWhere('requirement_3', 'like', '%' . $request->search . '%')
                ->orWhere('requirement_4', 'like', '%' . $request->search . '%')
                ->orWhere('requirement_5', 'like', '%' . $request->search . '%')
                ->orWhere('area', 'like', '%' . $request->search . '%')
                ->orWhere('entry', 'like', '%' . $request->search . '%')
                ->orWhere('entry_cost', 'like', '%' . $request->search . '%')
                ->latest()->with('eventreviews')->paginate(10)->withQueryString());

            $eventData = $events->map(function ($event) {
                $ratings = $event->eventReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;
                $booked = EventBooking::where('senderId', auth()->id())
                    ->where('eventId', $event->id)
                    ->exists();

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'user_id' => $event->user_id,
                    'user_name' => $event->user_name,
                    'user_slug' => $event->user_slug,
                    'image_1' => $event->image_1,
                    'image_2' => $event->image_2,
                    'image_3' => $event->image_3,
                    'image_4' => $event->image_4,
                    'image_5' => $event->image_5,
                    'description' => $event->description,
                    'requirement_1' => $event->requirement_1,
                    'requirement_2' => $event->requirement_2,
                    'requirement_3' => $event->requirement_3,
                    'requirement_4' => $event->requirement_4,
                    'requirement_5' => $event->requirement_5,
                    'mode' => $event->mode,
                    'area' => $event->area,
                    'location' => $event->location,
                    'date' => $event->date,
                    'time' => $event->time,
                    'entry' => $event->entry,
                    'entry_cost' => $event->entry_cost,
                    'contact' => $event->contact,
                    'show_contact' => $event->show_contact,
                    'club_id' => $event->club_id,
                    'booked' => $booked,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                    'created_at' => $event->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $eventData,
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage()
            ]);
        }
        //return EventResource::collection(Event::latest()->paginate(10));
        $events = EventResource::collection(Event::latest()->with('eventreviews')->paginate(10));

        $eventData = $events->map(function ($event) {
            $ratings = $event->eventReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;
            $booked = EventBooking::where('senderId', auth()->id())
                ->where('eventId', $event->id)
                ->exists();

            return [
                'id' => $event->id,
                'title' => $event->title,
                'slug' => $event->slug,
                'user_id' => $event->user_id,
                'user_name' => $event->user_name,
                'user_slug' => $event->user_slug,
                'image_1' => $event->image_1,
                'image_2' => $event->image_2,
                'image_3' => $event->image_3,
                'image_4' => $event->image_4,
                'image_5' => $event->image_5,
                'description' => $event->description,
                'requirement_1' => $event->requirement_1,
                'requirement_2' => $event->requirement_2,
                'requirement_3' => $event->requirement_3,
                'requirement_4' => $event->requirement_4,
                'requirement_5' => $event->requirement_5,
                'mode' => $event->mode,
                'area' => $event->area,
                'location' => $event->location,
                'date' => $event->date,
                'time' => $event->time,
                'entry' => $event->entry,
                'entry_cost' => $event->entry_cost,
                'contact' => $event->contact,
                'show_contact' => $event->show_contact,
                'club_id' => $event->club_id,
                'booked' => $booked,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'created_at' => $event->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $eventData,
            'current_page' => $events->currentPage(),
            'last_page' => $events->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $title = $request->title;

        if (!Event::count()) {
            $eventId = 1;
        } else {
            $eventId = Event::latest()->first()->id + 1;
        }

        $event = new Event();

        $slug = Str::slug($title, '-') . '-' . $eventId;
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $user_slug = auth()->user()->slug;
        $description = $request->input('description');
        $requirement_1 = $request->input('requirement_1');
        $requirement_2 = $request->input('requirement_2');
        $requirement_3 = $request->input('requirement_3');
        $requirement_4 = $request->input('requirement_4');
        $requirement_5 = $request->input('requirement_5');
        $mode = $request->input('mode');
        $area = $request->input('area');
        $location = $request->input('location');
        $date = $request->input('date');
        $time = $request->input('time');
        $entry = $request->input('entry');
        $entry_cost = $request->input('entry_cost');
        $contact = $request->input('contact');
        $show_contact = $request->input('show_contact');
        $club_id = $request->input('club_id');

        // create and save event

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $event->image_1 = $image_1;
        }
        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $event->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $event->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $event->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $event->image_5 = $image_5;
        }

        $event->title = $title;
        $event->slug = $slug;
        $event->user_id = $user_id;
        $event->user_name = $user_name;
        $event->user_slug = $user_slug;
        $event->description = $description;
        $event->requirement_1 = $requirement_1;
        $event->requirement_2 = $requirement_2;
        $event->requirement_3 = $requirement_3;
        $event->requirement_4 = $requirement_4;
        $event->requirement_5 = $requirement_5;
        $event->mode = $mode;
        $event->area = $area;
        $event->location = $location;
        $event->date = $date;
        $event->time = $time;
        $event->entry = $entry;
        $event->entry_cost = $entry_cost;
        $event->contact = $contact;
        $event->show_contact = $show_contact;
        $event->club_id = $club_id;
        $event->save();
    }
    // public function show(Event $event)
    // {
    //     //return new EventResource($event);

    //     $events = Event::find($event->id);
    //     $data = [
    //         "data" => $events,
    //         "avg_rate" => $events->average_rating,
    //         "comment_count" => $events->count_comment,
    //     ];

    //     return response()->json($data);
    // }

    // public function show(Event $event)
    // {
    //     $event = Event::find($event->id);

    //     $user = auth()->user();
    //     $booked = EventBooking::where('senderId', $user->id)->where('eventId', $event->id)->exists();

    //     $eventData = [
    //         'id' => $event->id,
    //         'title' => $event->title,
    //         'slug' => $event->slug,
    //         'user_id' => $event->user_id,
    //         'user_name' => $event->user_name,
    //         'user_slug' => $event->user_slug,
    //         'image_1' => $event->image_1,
    //         'image_2' => $event->image_2,
    //         'image_3' => $event->image_3,
    //         'image_4' => $event->image_4,
    //         'image_5' => $event->image_5,
    //         'description' => $event->description,
    //         'requirement_1' => $event->requirement_1,
    //         'requirement_2' => $event->requirement_2,
    //         'requirement_3' => $event->requirement_3,
    //         'requirement_4' => $event->requirement_4,
    //         'requirement_5' => $event->requirement_5,
    //         'mode' => $event->mode,
    //         'area' => $event->area,
    //         'location' => $event->location,
    //         'date' => $event->date,
    //         'time' => $event->time,
    //         'entry' => $event->entry,
    //         'entry_cost' => $event->entry_cost,#
    //         'contact' => $event->contact,
    //         'show_contact' => $event->show_contact,
    //         'club_id' => $event->club_id,
    //         'booked' => $booked,
    //     ];

    //     return response()->json([
    //         'data' => $eventData
    //     ]);
    // }

    public function show(Event $event)
    {
        //return new EventResource($event);
        $booked = false;
        if (auth()->user()) {
            $user = auth()->user();
            $booked = EventBooking::where('senderId', $user->id)->where('eventId', $event->id)->exists();
        }
        $events = Event::find($event->id);
        $data = [
            "data" => $events,
            "booked" => $booked,
            "avg_rate" => $events->average_rating,
            "comment_count" => $events->count_comment,
        ];

        return response()->json($data);
    }


    public function update(Request $request, Event $event)
    {
        if (auth()->user()->id != $event->user->id || auth()->user()->id != 1) {
            return abort(403);
        }
        $request->validate([
            'title' => 'required',
        ]);

        $title = $request->title;
        $description = $request->input('description');
        $requirement_1 = $request->input('requirement_1');
        $requirement_2 = $request->input('requirement_2');
        $requirement_3 = $request->input('requirement_3');
        $requirement_4 = $request->input('requirement_4');
        $requirement_5 = $request->input('requirement_5');
        $mode = $request->input('mode');
        $area = $request->input('area');
        $location = $request->input('location');
        $date = $request->input('date');
        $time = $request->input('time');
        $entry = $request->input('entry');
        $entry_cost = $request->input('entry_cost');
        $contact = $request->input('contact');
        $show_contact = $request->input('show_contact');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $event->image_1 = $image_1;
        }

        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $event->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $event->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $event->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/event');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $event->image_5 = $image_5;
        }

        // create and save event

        $event->title = $title;
        $event->description = $description;
        $event->requirement_1 = $requirement_1;
        $event->requirement_2 = $requirement_2;
        $event->requirement_3 = $requirement_3;
        $event->requirement_4 = $requirement_4;
        $event->requirement_5 = $requirement_5;
        $event->mode = $mode;
        $event->area = $area;
        $event->location = $location;
        $event->date = $date;
        $event->time = $time;
        $event->entry = $entry;
        $event->entry_cost = $entry_cost;
        $event->contact = $contact;
        $event->show_contact = $show_contact;
        return $event->save();
    }

    public function destroy(Event $event)
    {
        if (auth()->user()->id != $event->user->id || auth()->user()->id != 1) {
            return abort(403);
        }

        return $event->delete();
    }
}
