<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Events\MessageSent;
use App\Events\NewClubChat;
use App\Events\NewMessage;
use App\Http\Resources\UserChatRoomResource;
use App\Models\Category;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Models\UserChatRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UserChatRoomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $userchatrooms = UserChatRoomResource::collection(UserChatRoom::where('message', 'like', '%' . $request->search . '%')
                ->orWhere('user_name', 'like', '%' . $request->search . '%')
                ->oldest()->paginate(10000)->withQueryString());

            $userchatroomData = $userchatrooms->map(function ($userchatroom) {

                return [
                    'id' => $userchatroom->id,
                    'receiver_id' => $userchatroom->receiver_id,
                    'user_id' => $userchatroom->user_id,
                    'user_name' => $userchatroom->user_name,
                    'user_slug' => $userchatroom->user_slug,
                    'image_1' => $userchatroom->image_1,
                    'message' => $userchatroom->message,
                    'created_at' => $userchatroom->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $userchatroomData,
                'current_page' => $userchatrooms->currentPage(),
                'last_page' => $userchatrooms->lastPage()
            ]);
        }
        //$userchatrooms = UserChatRoomResource::collection(UserChatRoom::latest()->paginate(10000));
        $userchatrooms = UserChatRoomResource::collection(UserChatRoom::oldest()->paginate(10000));

        $userchatroomData = $userchatrooms->map(function ($userchatroom) {

            return [
                'id' => $userchatroom->id,
                'receiver_id' => $userchatroom->receiver_id,
                'user_id' => $userchatroom->user_id,
                'user_name' => $userchatroom->user_name,
                'user_slug' => $userchatroom->user_slug,
                'image_1' => $userchatroom->image_1,
                'message' => $userchatroom->message,
                'created_at' => $userchatroom->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $userchatroomData,
            'current_page' => $userchatrooms->currentPage(),
            'last_page' => $userchatrooms->lastPage()
        ]);
    }
    public function store(Request $request)
    {

        if (!UserChatRoom::count()) {
            $userchatroomId = 1;
        } else {
            $userchatroomId = UserChatRoom::latest()->first()->id + 1;
        }

        $userchatroom = new UserChatRoom();

        $user = auth()->user();
        $user_name = auth()->user()->name;
        $user_id = $request->input('user_id');
        $user_slug = auth()->user()->slug;
        $receiver_id = $request->input('receiver_id');
        $message = $request->input('message');
        
        // created and save userchatroom

        $request->validate([
            'file1' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,avif,webp,bmp,eps,heif,psd,svg,tiff|max:2048',
        ]);

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/userchatroom');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $userchatroom->image_1 = $image_1;
        }

        $userchatroom->receiver_id = $receiver_id;
        $userchatroom->user_id = $user_id;
        $userchatroom->user_name = $user_name;
        $userchatroom->user_slug = $user_slug;
        $userchatroom->message = $message;
        $userchatroom->save();

        $options = [
            'cluster' => 'ap2',
            'useTLS' => true,
        ];
        $pusher = new Pusher('9820769533922d6161b6', '91e8d1e35fc91f126633', '1414441', $options);

        $pusher->trigger('my-user-channel', 'my-user-event', $userchatroom);

        return response($userchatroom['message']);
        
    }
    
    public function show(UserChatRoom $userchatroom)
    {
        $userchatroom = UserChatRoom::find($userchatroom->id);

        $user = auth()->user();

        $userchatroomData = [
            'id' => $userchatroom->id,
            'receiver_id' => $userchatroom->receiver_id,
            'user_id' => $userchatroom->user_id,
            'user_name' => $userchatroom->user_name,
            'user_slug' => $userchatroom->user_slug,
            'image_1' => $userchatroom->image_1,
            'message' => $userchatroom->message,
        ];

        return response()->json([
            'data' => $userchatroomData
        ]);
    }

    public function update(Request $request, UserChatRoom $userchatroom)
    {
        //
    }

    public function destroy(UserChatRoom $userchatroom)
    {
        return $userchatroom->delete();
    }
}
