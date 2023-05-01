<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventBookingResource;
use Illuminate\Http\Request;
use App\Models\EventBooking;
use Illuminate\Support\Facades\DB;

class EventBookingController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();
        $eventId = $request->input('eventId');

        // check if the user has already booked the event
        $bookingExists = EventBooking::where('senderId', $user->id)->where('eventId', $eventId)->exists();
        if ($bookingExists) {
            return response()->json(['message' => 'You have already booked this event.'], 409);
        }


        $eventreport = new EventBooking();

        $eventImage = $request->input('eventImage');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $userId = $request->input('userId');
        $eventId = $request->input('eventId');
        $eventTitle = $request->input('eventTitle');
        $eventSlug = $request->input('eventSlug');

        $eventDescription = $request->input('eventDescription');
        $eventDate = $request->input('eventDate');
        $eventTime = $request->input('eventTime');


        // create and save eventreport

        $eventreport->eventImg = $eventImage;
        $eventreport->senderName = $senderName;
        $eventreport->senderPhone = $senderPhone;
        $eventreport->senderId = $senderId;
        $eventreport->userId = $userId;
        $eventreport->eventId = $eventId;
        $eventreport->eventTitle = $eventTitle;
        $eventreport->eventSlug = $eventSlug;
        $eventreport->eventDescription = $eventDescription;
        $eventreport->eventDate = $eventDate;
        $eventreport->eventTime = $eventTime;
        $eventreport->save();
    }

    public function index()
    {
        // $eventcategories = EventBooking::get();
        // return EventBookingResource::collection($eventcategories);
        //return EventBooking::latest()->get();
        return EventBookingResource::collection(EventBooking::latest()->get());
    }

    public function getSub()
    {
        return EventBooking::latest()->get();
    }

    public function show(EventBooking $eventreport)
    {
        return $eventreport;
    }

    public function update(Request $request, EventBooking $eventreport)
    {
        // $request->validate([
        //     'name' => 'required | unique:event_reports',
        // ]);

        // $name = $request->input('name');
        // $eventreport->name = $name;

        // return $eventreport->save();
    }

    public function destroy(EventBooking $eventreport)
    {
        return $eventreport->delete();
    }
}
