<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClubChatRoomResource;
use App\Http\Resources\ClubResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\ClubChatRoom;
use App\Models\RoomUser;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $clubs = ClubResource::collection(Club::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->latest()->with('clubchats')->paginate(10)->withQueryString());

            $clubData = $clubs->map(function ($club) {
                $counts = $club->clubChats;
                $count = $counts->count();

                return [
                    'id' => $club->id,
                    'name' => $club->name,
                    'slug' => $club->slug,
                    'user_id' => $club->user_id,
                    'image_1' => $club->image_1,
                    'description' => $club->description,
                    'text_count' => $count,
                    'created_at' => $club->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $clubData,
                'current_page' => $clubs->currentPage(),
                'last_page' => $clubs->lastPage()
            ]);
        }
        $clubs = ClubResource::collection(Club::latest()->with('clubchats')->paginate(10));

        $clubData = $clubs->map(function ($club) {
            $counts = $club->clubChats;
            $count = $counts->count();

            return [
                'id' => $club->id,
                'name' => $club->name,
                'slug' => $club->slug,
                'user_id' => $club->user_id,
                'image_1' => $club->image_1,
                'description' => $club->description,
                'text_count' => $count,
                'created_at' => $club->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $clubData,
            'current_page' => $clubs->currentPage(),
            'last_page' => $clubs->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file1' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
        ]);
        $name = $request->name;

        if (!Club::count()) {
            $clubId = 1;
        } else {
            $clubId = Club::latest()->first()->id + 1;
        }

        $club = new Club();

        $slug = Str::slug($name, '-') . '-' . $clubId;
        $user_id = auth()->user()->id;
        $user_slug = auth()->user()->slug;
        $description = $request->input('description');

        // create and save club

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/clubs');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $club->image_1 = $image_1;
        }

        $club->name = $name;
        $club->slug = $slug;
        $club->user_id = $user_id;
        $club->user_slug = $user_slug;
        $club->description = $description;
        $club->save();
    }

    // public function show(Club $club)
    // {
    //     $club = Club::find($club->id);

    //     $user = auth()->user();
    //     $subscribed = RoomUser::where('user_id', $user->id)->where('room_id', $club->id)->exists();

    //     $clubData = [
    //         'id' => $club->id,
    //         'room_id' => $club->room_id,
    //         'user_id' => $club->user_id,
    //         'user_name' => $club->user_name,
    //         'user_slug' => $club->user_slug,
    //         'image_1' => $club->image_1,
    //         'message' => $club->message,
    //         'subscribed' => $subscribed,
    //     ];

    //     return response()->json([
    //         'data' => $clubData
    //     ]);
    // }


    // public function show(Club $club)
    // {
    //     //return new ClubResource($club);

    //     $clubs = Club::find($club->id);
    //     $data = [
    //         "data" => $clubs,
    //         "message_count" => $clubs->count_message,
    //     ];

    //     return response()->json($data);
    // }

    public function show(Club $club)
    {
        $user = auth()->user();
        $subscribed = RoomUser::where('user_id', $user->id)->where('room_id', $club->id)->exists();

        $clubData = [
            'id' => $club->id,
            'name' => $club->name,
            'slug' => $club->slug,
            'user_id' => $club->user_id,
            'user_slug' => $club->user_slug,
            'image_1' => $club->image_1,
            'description' => $club->description,
            'subscribed' => $subscribed,
        ];
        $clubchatrooms = ClubChatRoomResource::collection(ClubChatRoom::where('room_id', $club->id)->oldest()->paginate(10000));

        $chatMessageData = $clubchatrooms->map(function ($clubchatroom) {

            return [
                'id' => $clubchatroom->id,
                'room_id' => $clubchatroom->room_id,
                'user_id' => $clubchatroom->user_id,
                'user_name' => $clubchatroom->user_name,
                'user_slug' => $clubchatroom->user_slug,
                'image_1' => $clubchatroom->image_1,
                'message' => $clubchatroom->message,
                'created_at' => $clubchatroom->created_at->diffForHumans(),
            ];
        });

        $messageCount = $clubchatrooms->count();

        return response()->json([
            'data' => $clubData,
            'messages' => $chatMessageData,
            'message_count' => $messageCount,
        ]);
    }



    public function show_club_articles(Club $club)
    {
        $articles = $club->clubArticles;
        $count = $articles->count();

        $clubData = [
            'club_articles_count' => $articles->where('posts', $club->club_id)->count(),
        ];

        return response()->json([
            'data' => $clubData,
        ]);
    }

    public function show_club_markets(Club $club)
    {
        $markets = $club->clubMarkets;
        $count = $markets->count();

        $clubData = [
            'club_markets_count' => $markets->where('markets', $club->club_id)->count(),
        ];

        return response()->json([
            'data' => $clubData,
        ]);
    }

    public function show_club_events(Club $club)
    {
        $events = $club->clubEvents;
        $count = $events->count();

        $clubData = [
            'club_events_count' => $events->where('events', $club->club_id)->count(),
        ];

        return response()->json([
            'data' => $clubData,
        ]);
    }

    public function show_club_polls(Club $club)
    {
        $polls = $club->clubPolls;
        $count = $polls->count();

        $clubData = [
            'club_polls_count' => $polls->where('polls', $club->club_id)->count(),
        ];

        return response()->json([
            'data' => $clubData,
        ]);
    }

    public function show_club_resources(Club $club)
    {
        $resources = $club->clubResources;
        $count = $resources->count();

        $clubData = [
            'club_resources_count' => $resources->where('resources', $club->club_id)->count(),
        ];

        return response()->json([
            'data' => $clubData,
        ]);
    }

    public function show_club_users(Club $club)
    {
        $users = $club->clubUsers;
        $count = $users->count();

        $usersData = [
            'club_users_count' => $users->where('room_users', $club->room_id)->count(),
        ];

        return response()->json([
            'data' => $usersData,
        ]);
    }


    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file1' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
        ]);

        $name = $request->name;

        $description = $request->input('description');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/clubs');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $club->image_1 = $image_1;
        }
        // create and save club
        $club->name = $name;
        $club->description = $description;
        return $club->save();
    }

    public function destroy(Club $club)
    {
        return $club->delete();
    }
}
