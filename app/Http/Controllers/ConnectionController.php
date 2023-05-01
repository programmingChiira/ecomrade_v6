<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConnectionResource;
use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\MarketSubCategory;

class ConnectionController extends Controller
{
    public function store(Request $request)
    {
        $sender_id = auth()->user()->id;
        $sender_image = auth()->user()->profile_pic;
        $sender_name = auth()->user()->name;
        $sender_slug = auth()->user()->slug;
        $receiver_id = $request->input('receiver_id');
        $receiver_image = $request->input('receiver_image');
        $receiver_slug = $request->input('receiver_slug');
        $receiver_name = $request->input('receiver_name');
        $connection = new Connection();
        $connection->sender_id = $sender_id;
        $connection->sender_image = $sender_image;
        $connection->sender_slug = $sender_slug;
        $connection->sender_name = $sender_name;
        $connection->receiver_id = $receiver_id;
        $connection->receiver_image = $receiver_image;
        $connection->receiver_slug = $receiver_slug;
        $connection->receiver_name = $receiver_name;
        $connection->status = "Pending";

        return $connection->save();
    }

    public function index(Request $request)
    {
        if ($request->search) {

            $connections = ConnectionResource::collection(Connection::where('sender_name', 'like', '%' . $request->search . '%')
                ->orWhere('receiver_name', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString());

            $connectionData = $connections->map(function ($connection) {

                return [
                    'id' => $connection->id,
                    'sender_id' => $connection->sender_id,
                    'sender_image' => $connection->sender_image,
                    'sender_name' => $connection->sender_name,
                    'sender_slug' => $connection->sender_slug,
                    'receiver_id' => $connection->receiver_id,
                    'receiver_image' => $connection->receiver_image,
                    'receiver_name' => $connection->receiver_name,
                    'receiver_slug' => $connection->receiver_slug,
                    'status' => $connection->status,
                ];
            });

            return response()->json([
                'data' => $connectionData,
                'current_page' => $connections->currentPage(),
                'last_page' => $connections->lastPage()
            ]);
        }
        //return ConnectionResource::collection(Connection::latest()->paginate(10));
        $connections = ConnectionResource::collection(Connection::latest()->paginate(10));

        $connectionData = $connections->map(function ($connection) {

            $sendNotConnected = Connection::where('sender_id', auth()->id())
                ->where('status', 'Pending')
                ->exists();

            $receiveNotConnected = Connection::where('receiver_id', auth()->id())
                ->where('status', 'Pending')
                ->exists();

            $sendConnected = Connection::where('sender_id', auth()->id())
                ->where('status', 'Connected')
                ->exists();

            $receiveConnected = Connection::where('receiver_id', auth()->id())
                ->where('status', 'Connected')
                ->exists();

            return [
                'id' => $connection->id,
                'sender_id' => $connection->sender_id,
                'sender_image' => $connection->sender_image,
                'sender_name' => $connection->sender_name,
                'sender_slug' => $connection->sender_slug,
                'receiver_id' => $connection->receiver_id,
                'receiver_image' => $connection->receiver_image,
                'receiver_name' => $connection->receiver_name,
                'receiver_slug' => $connection->receiver_slug,
                'sendNotConnected' => $sendNotConnected,
                'receiveNotConnected' => $receiveNotConnected,
                'sendConnected' => $sendConnected,
                'receiveConnected' => $receiveConnected,
                'status' => $connection->status,
            ];
        });

        return response()->json([
            'data' => $connectionData,
            'current_page' => $connections->currentPage(),
            'last_page' => $connections->lastPage()
        ]);
    }

    public function show(Connection $connection)
    {
        return $connection;
    }

    public function update(Request $request, Connection $connection)
    {
        $connection->status = "Connected";

        return $connection->save();
    }

    public function destroy(Connection $connection)
    {
        return $connection->delete();
    }
}
