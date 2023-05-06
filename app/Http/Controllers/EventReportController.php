<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventReportResource;
use Illuminate\Http\Request;
use App\Models\EventReport;
use Illuminate\Support\Facades\DB;

class EventReportController extends Controller
{
    public function store(Request $request)
    {

        //dd($request);
        $eventreport = new EventReport();

        $image_1 = $request->input('image_1');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $user_id = $request->input('user_id');
        $id = $request->input('id');
        $event_title = $request->input('event_title');
        $slug = $request->input('slug');

        $event_issue = $request->input('event_issue');
        $event_complaint = $request->input('event_complaint');


        // create and save eventreport

        $eventreport->eventImg = $image_1;
        $eventreport->senderName = $senderName;
        $eventreport->senderPhone = $senderPhone;
        $eventreport->senderId = $senderId;
        $eventreport->userId = $user_id;
        $eventreport->eventId = $id;
        $eventreport->eventTitle = $event_title;
        $eventreport->eventSlug = $slug;
        $eventreport->eventIssue = $event_issue;
        $eventreport->eventComplaint = $event_complaint;
        $eventreport->save();
    }

    public function index()
    {
        // $marketcategories = Year::get();
        // return YearResource::collection($marketcategories);
        //return Year::latest()->get();
        return EventReportResource::collection(EventReport::latest()->get());
    }

    public function getSub()
    {
        return EventReport::latest()->get();
    }

    public function show(EventReport $eventreport)
    {
        return $eventreport;
    }

    public function update(Request $request, EventReport $eventreport)
    {
        // $request->validate([
        //     'name' => 'required | unique:event_reports',
        // ]);

        // $name = $request->input('name');
        // $eventreport->name = $name;

        // return $eventreport->save();
    }

    public function destroy(EventReport $eventreport)
    {
        return $eventreport->delete();
    }
}
