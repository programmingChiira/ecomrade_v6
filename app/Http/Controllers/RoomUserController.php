<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomUserResource;
use Illuminate\Http\Request;
use App\Models\RoomUser;
use Illuminate\Support\Facades\DB;

class RoomUserController extends Controller
{
    public function store(Request $request)
    {
        $userSubscription = new RoomUser();

        $user_id = $request->input('user_id');
        $room_id = $request->input('room_id');

        // create and save userSubscription

        $userSubscription->room_id = $room_id;
        $userSubscription->user_id = $user_id;
        $userSubscription->save();
    }

    public function show(RoomUser $userSubscription)
    {
        //
    }


    public function update(Request $request, RoomUser $userSubscription)
    {
        //
    }

    public function destroy(RoomUser $userSubscription)
    {
        return $userSubscription->delete();
    }
}
