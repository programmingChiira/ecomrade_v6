<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Message;
use Pusher\Pusher;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Events\MyEvent; // Import the MyEvent class


class MessageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $messages = MessageResource::collection(Message::where('message', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString());

            $messageData = $messages->map(function ($message) {

                return [
                    'message' => $message->message,
                    'created_at' => $message->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $messageData,
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage()
            ]);
        }
        //return MessageResource::collection(Message::latest()->paginate(10));
        $messages = MessageResource::collection(Message::latest()->paginate(10));

        $messageData = $messages->map(function ($message) {

            return [
                'message' => $message->message,
                'created_at' => $message->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $messageData,
            'current_page' => $messages->currentPage(),
            'last_page' => $messages->lastPage()
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'message' => 'required',
    //     ]);
    //     $message = new Message();
    //     $message = $request->input('message');

    //     event(new MyEvent($message));


    //     $message->message = $message;
    //     $message->save();
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        // Save the message to the database
        $options = [
            'cluster' => 'ap2',
            'useTLS' => true,
        ];
        $pusher = new Pusher('9820769533922d6161b6', '91e8d1e35fc91f126633', '1414441', $options);

        $pusher->trigger('my-channel', 'my-event', $data);
        $text = new Message();
        $message = $request->input('message');
       
        $text->message = $message;
        $text->save();

        return response($data['message']);
    }



    public function show(Message $message)
    {
        //return new MessageResource($message);

        $messages = Message::find($message->id);
        $data = [
            "data" => $messages,
            "avg_rate" => $messages->average_rating,
            "comment_count" => $messages->count_comment,
        ];

        return response()->json($data);
    }

    public function update(Request $request, Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        return $message->delete();
    }
}
