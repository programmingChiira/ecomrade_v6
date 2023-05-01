<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventReviewResource;
use Illuminate\Http\Request;
use App\Models\EventReview;
use Illuminate\Support\Facades\DB;
class EventReviewController extends Controller
{
    public function store(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $senderName = $request->input('senderName');
        $senderId = $request->input('senderId');
        $userId = $request->input('userId');
        $eventId = $request->input('eventId');
        $eventTitle = $request->input('eventTitle');
        $comment = $request->input('comment');

        $eventreview = new EventReview();

        $eventreview->ratingValue = $ratingValue;
        $eventreview->senderName = $senderName;
        $eventreview->senderId = $senderId;
        $eventreview->userId = $userId;
        $eventreview->eventId = $eventId;
        $eventreview->eventTitle = $eventTitle;
        $eventreview->comment = $comment;

        return $eventreview->save();
    }

    public function index()
    {
        // $eventcategories = EventReview::get();
        // return EventReviewResource::collection($eventcategories);
        //return EventReview::latest()->get();
        return EventReviewResource::collection(EventReview::latest()->get());
    }

     public function getSub()
    {
        return EventReview::latest()->get();
    }

    public function show(EventReview $eventreview)
    {
        return $eventreview;
    }

    public function update(Request $request, EventReview $eventreview)
    {
        $request->validate([
            'name' => 'required | unique:event_reviews',
        ]);

        $name = $request->input('name');
        $eventreview->name = $name;

        return $eventreview->save();
    }

    public function destroy(EventReview $eventreview)
    {
        return $eventreview->delete();
    }
}
