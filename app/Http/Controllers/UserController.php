<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserChatRoomResource;
use App\Http\Resources\UserResource;
use App\Models\Connection;
use App\Models\MarketCart;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\UserChatRoom;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $users = UserResource::collection(User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('type', 'like', '%' . $request->search . '%')
                ->orWhere('youtube', 'like', '%' . $request->search . '%')
                ->orWhere('instagram', 'like', '%' . $request->search . '%')
                ->orWhere('twitter', 'like', '%' . $request->search . '%')
                ->orWhere('facebook', 'like', '%' . $request->search . '%')
                ->orWhere('linkedin', 'like', '%' . $request->search . '%')
                ->orWhere('github', 'like', '%' . $request->search . '%')
                ->orWhere('title', 'like', '%' . $request->search . '%')
                ->orWhere('personal_description', 'like', '%' . $request->search . '%')
                ->orWhere('campus_area', 'like', '%' . $request->search . '%')
                ->orWhere('campus', 'like', '%' . $request->search . '%')
                ->orWhere('gender', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString());

            $userData = $users->map(function ($user) {

                $connecter = Connection::where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id)
                    ->exists();

                $connector = Connection::where('receiver_id', auth()->id())
                    ->where('sender_id', $user->id)
                    ->exists();

                $totalCartCount = MarketCart::where('senderId', auth()->id())
                    ->count();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'slug' => $user->slug,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'type' => $user->type,
                    'youtube' => $user->youtube,
                    'instagram' => $user->instagram,
                    'twitter' => $user->twitter,
                    'facebook' => $user->facebook,
                    'linkedin' => $user->linkedin,
                    'github' => $user->github,
                    'profile_pic' => $user->profile_pic,
                    'personal_description' => $user->personal_description,
                    'campus_area' => $user->campus_area,
                    'campus' => $user->campus,
                    'gender' => $user->gender,
                    'connecter' => $connecter,
                    'connector' => $connector,
                    'totalCartCount' => $totalCartCount,
                    'created_at' => $user->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $userData,
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage()
            ]);
        }
        $users = UserResource::collection(User::latest()->paginate(10));

        $userData = $users->map(function ($user) {

            $connecter = Connection::where('sender_id', auth()->id())
                ->where('receiver_id', $user->id)
                ->exists();

            $connector = Connection::where('receiver_id', auth()->id())
                ->where('sender_id', $user->id)
                ->exists();

            $totalCartCount = MarketCart::where('senderId', auth()->id())
                ->count();

            return [
                'id' => $user->id,
                'name' => $user->name,
                'slug' => $user->slug,
                'phone' => $user->phone,
                'email' => $user->email,
                'type' => $user->type,
                'youtube' => $user->youtube,
                'instagram' => $user->instagram,
                'twitter' => $user->twitter,
                'facebook' => $user->facebook,
                'linkedin' => $user->linkedin,
                'github' => $user->github,
                'profile_pic' => $user->profile_pic,
                'personal_description' => $user->personal_description,
                'campus_area' => $user->campus_area,
                'campus' => $user->campus,
                'gender' => $user->gender,
                'connecter' => $connecter,
                'connector' => $connector,
                'totalCartCount' => $totalCartCount,
                'created_at' => $user->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $userData,
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage()
        ]);
    }

    public function searchcomrade(Request $request)
    {
        if ($request->search) {
            $users = UserResource::collection(User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('type', 'like', '%' . $request->search . '%')
                ->orWhere('youtube', 'like', '%' . $request->search . '%')
                ->orWhere('instagram', 'like', '%' . $request->search . '%')
                ->orWhere('twitter', 'like', '%' . $request->search . '%')
                ->orWhere('facebook', 'like', '%' . $request->search . '%')
                ->orWhere('linkedin', 'like', '%' . $request->search . '%')
                ->orWhere('github', 'like', '%' . $request->search . '%')
                ->orWhere('title', 'like', '%' . $request->search . '%')
                ->orWhere('personal_description', 'like', '%' . $request->search . '%')
                ->orWhere('campus_area', 'like', '%' . $request->search . '%')
                ->orWhere('campus', 'like', '%' . $request->search . '%')
                ->orWhere('gender', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString());

            $userData = $users->map(function ($user) {

                $connecter = Connection::where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id)
                    ->exists();

                $connector = Connection::where('receiver_id', auth()->id())
                    ->where('sender_id', $user->id)
                    ->exists();

                $totalCartCount = MarketCart::where('senderId', auth()->id())
                    ->count();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'slug' => $user->slug,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'type' => $user->type,
                    'youtube' => $user->youtube,
                    'instagram' => $user->instagram,
                    'twitter' => $user->twitter,
                    'facebook' => $user->facebook,
                    'linkedin' => $user->linkedin,
                    'github' => $user->github,
                    'profile_pic' => $user->profile_pic,
                    'personal_description' => $user->personal_description,
                    'campus_area' => $user->campus_area,
                    'campus' => $user->campus,
                    'gender' => $user->gender,
                    'connecter' => $connecter,
                    'connector' => $connector,
                    'totalCartCount' => $totalCartCount,
                    'created_at' => $user->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $userData,
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage()
            ]);
        }
    }
    public function getUserData()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }

    // public function index(Request $request)
    // {
    //     return UserResource::collection(Users::latest()->paginate(10));
    // }

    public function store(Request $request)
    {
        //
    }

    // public function show(Users $user)
    // {
    //     return new UserResource($user);
    // }

    public function show(Users $user)
    {
        $user = Users::find($user->id);

        $sendNotConnected = Connection::where('sender_id', auth()->id())
            ->where('receiver_id', $user->id)
            ->where('status', 'Pending')
            ->exists();

        $sendNotConnectedCount = Connection::where('sender_id', auth()->id())
            ->where('status', 'Pending')
            ->count();


        $receiveNotConnected = Connection::where('receiver_id', auth()->id())
            ->where('sender_id', $user->id)
            ->where('status', 'Pending')
            ->exists();

        $receiveNotConnectedCount = Connection::where('receiver_id', auth()->id())
            ->where('status', 'Pending')
            ->count();

        $sendConnected = Connection::where('sender_id', auth()->id())
            ->where('receiver_id', $user->id)
            ->where('status', 'Connected')
            ->exists();

        $sendConnectedCount = Connection::where('sender_id', auth()->id())
            ->where('status', 'Connected')
            ->count();

        $receiveConnected = Connection::where('receiver_id', auth()->id())
            ->where('sender_id', $user->id)
            ->where('status', 'Connected')
            ->exists();

        $receiveConnectedCount = Connection::where('receiver_id', auth()->id())
            ->where('status', 'Connected')
            ->count();

        $connectedUsersCount = $receiveConnectedCount + $sendConnectedCount;

        $totalCartCount = MarketCart::where('senderId', auth()->id())
            ->count();


        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'slug' => $user->slug,
            'phone' => $user->phone,
            'email' => $user->email,
            'type' => $user->type,
            'youtube' => $user->youtube,
            'instagram' => $user->instagram,
            'twitter' => $user->twitter,
            'facebook' => $user->facebook,
            'linkedin' => $user->linkedin,
            'github' => $user->github,
            'profile_pic' => $user->profile_pic,
            'personal_description' => $user->personal_description,
            'campus_area' => $user->campus_area,
            'campus' => $user->campus,
            'gender' => $user->gender,
            'sendNotConnected' => $sendNotConnected,
            'sendNotConnectedCount' => $sendNotConnectedCount,
            'receiveNotConnected' => $receiveNotConnected,
            'receiveNotConnectedCount' => $receiveNotConnectedCount,
            'sendConnected' => $sendConnected,
            'receiveConnected' => $receiveConnected,
            'connectedUsersCount' => $connectedUsersCount,
            'totalCartCount' => $totalCartCount,
            'created_at' => $user->created_at->diffForHumans(),
        ];

        $userchatrooms = UserChatRoomResource::collection(
            UserChatRoom::where('receiver_id', auth()->id())
                ->where('user_id', $user->id)
                ->orWhere('receiver_id', $user->id)
                ->where('user_id', auth()->id())
                ->oldest()
                ->paginate(10000)
        );


        $chatMessageData = $userchatrooms->map(function ($userchatroom) {

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

        $messageCount = $userchatrooms->count();

        return response()->json([
            'data' => $userData,
            'messages' => $chatMessageData,
            'message_count' => $messageCount,
        ]);
    }

    public function update(Request $request, Users $user)
    {
        $request->validate([
            'file' => 'nullable | image',
            'name' => 'required',
            'phone' => 'required',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $gender = $request->input('gender');

        $title = $request->input('title');
        $personal_description = $request->input('personal_description');
        $campus = $request->input('campus');
        $campus_area = $request->input('campus_area');

        $youtube = $request->input('youtube');
        $instagram = $request->input('instagram');
        $twitter = $request->input('twitter');
        $facebook = $request->input('facebook');

        $linkedin = $request->input('linkedin');
        $github = $request->input('github');

        if ($request->file('file')) {
            File::delete($user->profile_pic);

            $image = $request->file('file');
            //$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $profile_pic = $request->file('file')->store('');

            $destinationPath = public_path('img/profiles');
            $img = Image::make($image->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $profile_pic);

            $user->profile_pic = $profile_pic;
        }

        // create and save user
        $user->name = $name;
        $user->phone = $phone;
        $user->email = $email;
        $user->gender = $gender;
        $user->title = $title;
        $user->personal_description = $personal_description;
        $user->campus = $campus;
        $user->campus_area = $campus_area;
        $user->youtube = $youtube;
        $user->instagram = $instagram;
        $user->twitter = $twitter;
        $user->facebook = $facebook;
        $user->linkedin = $linkedin;
        $user->github = $github;
        return $user->save();
    }

    public function updatePassword(Request $request, Users $user)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->input('current_password')])) {
            return response()->json(['error' => 'Current password does not match'], 403);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Users $user)
    {
        if (auth()->user()->id != $user->user->id || auth()->user()->id == 1) {
            return abort(403);
        }

        return $user->delete();
    }
}
