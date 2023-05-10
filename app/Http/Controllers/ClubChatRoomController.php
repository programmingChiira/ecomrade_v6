<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\MessageSent;
use App\Events\NewClubChat;
use App\Events\NewMessage;
use App\Http\Resources\ClubChatRoomResource;
use App\Models\Category;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Models\ClubChatRoom;
use App\Models\RoomUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ClubChatRoomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $clubchatrooms = ClubChatRoomResource::collection(ClubChatRoom::where('message', 'like', '%' . $request->search . '%')
                ->orWhere('user_name', 'like', '%' . $request->search . '%')
                ->oldest()->paginate(10000)->withQueryString());

            $clubchatroomData = $clubchatrooms->map(function ($clubchatroom) {

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

            return response()->json([
                'data' => $clubchatroomData,
                'current_page' => $clubchatrooms->currentPage(),
                'last_page' => $clubchatrooms->lastPage()
            ]);
        }
        //$clubchatrooms = ClubChatRoomResource::collection(ClubChatRoom::latest()->paginate(10000));
        $clubchatrooms = ClubChatRoomResource::collection(ClubChatRoom::oldest()->paginate(10000));

        $clubchatroomData = $clubchatrooms->map(function ($clubchatroom) {

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

        return response()->json([
            'data' => $clubchatroomData,
            'current_page' => $clubchatrooms->currentPage(),
            'last_page' => $clubchatrooms->lastPage()
        ]);
    }

    // public function index()
    // {
    //     $user_id = Auth::id();
    //     $club_chats = ClubChatRoom::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

    //     return response()->json([
    //         'club_chats' => $club_chats
    //     ]);
    // }

    public function store(Request $request)
    {

        if (!ClubChatRoom::count()) {
            $clubchatroomId = 1;
        } else {
            $clubchatroomId = ClubChatRoom::latest()->first()->id + 1;
        }

        $clubchatroom = new ClubChatRoom();

        $user = auth()->user();
        $user_name = auth()->user()->name;
        $user_id = $request->input('user_id');
        $user_slug = auth()->user()->slug;
        $room_id = $request->input('room_id');
        $message = $request->input('message');

        // check if the user has already subscribed the event
        $userExists = RoomUser::where('user_id', $user->id)->where('room_id', $room_id)->exists();
        if (!$userExists) {
            return response()->json(['message' => 'You need to join room to allow chatting.'], 409);
        }
        // create and save clubchatroom

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/chatroom');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $clubchatroom->image_1 = $image_1;
        }

        $clubchatroom->room_id = $room_id;
        $clubchatroom->user_id = $user_id;
        $clubchatroom->user_name = $user_name;
        $clubchatroom->user_slug = $user_slug;
        $clubchatroom->message = $message;
        $clubchatroom->save();

        $options = [
            'cluster' => 'ap2',
            'useTLS' => true,
        ];
        $pusher = new Pusher('9820769533922d6161b6', '91e8d1e35fc91f126633', '1414441', $options);

        $pusher->trigger('my-club-channel', 'my-club-event', $clubchatroom);

        return response($clubchatroom['message']);
        
    }
    // public function show(ClubChatRoom $clubchatroom)
    // {
    //     //return new ClubChatRoomResource($clubchatroom);

    //     $clubchatrooms = ClubChatRoom::find($clubchatroom->id);
    //     $data = [
    //         "data" => $clubchatrooms,
    //     ];

    //     return response()->json($data);
    // }

    public function show(ClubChatRoom $clubchatroom)
    {
        $clubchatroom = ClubChatRoom::find($clubchatroom->id);

        $user = auth()->user();
        $subscribed = RoomUser::where('user_id', $user->id)->where('room_id', $clubchatroom->id)->exists();

        $clubchatroomData = [
            'id' => $clubchatroom->id,
            'room_id' => $clubchatroom->room_id,
            'user_id' => $clubchatroom->user_id,
            'user_name' => $clubchatroom->user_name,
            'user_slug' => $clubchatroom->user_slug,
            'image_1' => $clubchatroom->image_1,
            'message' => $clubchatroom->message,
            'subscribed' => $subscribed,
        ];

        return response()->json([
            'data' => $clubchatroomData
        ]);
    }

    public function update(Request $request, ClubChatRoom $clubchatroom)
    {
        //
    }

    public function destroy(ClubChatRoom $clubchatroom)
    {
        return $clubchatroom->delete();
    }
}
