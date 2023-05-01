<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\Message;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $feeds = FeedResource::collection(Feed::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('contact', 'like', '%' . $request->search . '%')
                ->orWhere('feedback', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString());

            $feedData = $feeds->map(function ($feed) {

                return [
                    'name' => $feed->name,
                    'contact' => $feed->contact,
                    'feedback' => $feed->feedback,
                    'created_at' => $feed->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $feedData,
                'current_page' => $feeds->currentPage(),
                'last_page' => $feeds->lastPage()
            ]);
        }
        //return FeedResource::collection(Feed::latest()->paginate(10));
        $feeds = FeedResource::collection(Feed::latest()->paginate(10));

        $feedData = $feeds->map(function ($feed) {

            return [
                'name' => $feed->name,
                'contact' => $feed->contact,
                'feedback' => $feed->feedback,
                'created_at' => $feed->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $feedData,
            'current_page' => $feeds->currentPage(),
            'last_page' => $feeds->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'feedback' => 'required',
        ]);
        $feed = new Feed();
        $name = $request->input('name');
        $contact = $request->input('contact');
        $feedback = $request->input('feedback');
       
        $feed->name = $name;
        $feed->contact = $contact;
        $feed->feedback = $feedback;
        $feed->save();
    }

    public function show(Feed $feed)
    {
        //return new FeedResource($feed);

        $feeds = Feed::find($feed->id);
        $data = [
            "data" => $feeds,
            "avg_rate" => $feeds->average_rating,
            "comment_count" => $feeds->count_comment,
        ];

        return response()->json($data);
    }

    public function update(Request $request, Feed $feed)
    {
        //
    }

    public function destroy(Feed $feed)
    {
        if (auth()->user()->id !== $feed->user->id || auth()->user()->type != 'admin') {
            return abort(403);
        }

        return $feed->delete();
    }
}
