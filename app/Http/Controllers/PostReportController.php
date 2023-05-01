<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostReportResource;
use Illuminate\Http\Request;
use App\Models\PostReport;
use Illuminate\Support\Facades\DB;

class PostReportController extends Controller
{
    public function store(Request $request)
    {

        //dd($request);
        $postreport = new PostReport();

        $image_1 = $request->input('image_1');
        $senderId = auth()->user()->id;
        $senderName = auth()->user()->name;
        $senderPhone = auth()->user()->phone;
        $user_id = $request->input('user_id');
        $id = $request->input('id');
        $post_name = $request->input('post_name');
        $post_category = $request->input('post_category');
        $slug = $request->input('slug');

        $post_issue = $request->input('post_issue');
        $post_complaint = $request->input('post_complaint');


        // create and save postreport

        $postreport->postImg = $image_1;
        $postreport->senderName = $senderName;
        $postreport->senderPhone = $senderPhone;
        $postreport->senderId = $senderId;
        $postreport->userId = $user_id;
        $postreport->postId = $id;
        $postreport->postName = $post_name;
        $postreport->postCat = $post_category;
        $postreport->postSlug = $slug;
        $postreport->postIssue = $post_issue;
        $postreport->postComplaint = $post_complaint;
        $postreport->save();
    }

    public function index()
    {
        // $postcategories = PostReport::get();
        // return PostReportResource::collection($postcategories);
        //return PostReport::latest()->get();
        return PostReportResource::collection(PostReport::latest()->get());
    }

    public function getSub()
    {
        return PostReport::latest()->get();
    }

    public function show(PostReport $postreport)
    {
        return $postreport;
    }

    public function update(Request $request, PostReport $postreport)
    {
        // $request->validate([
        //     'name' => 'required | unique:post_reports',
        // ]);

        // $name = $request->input('name');
        // $postreport->name = $name;

        // return $postreport->save();
    }

    public function destroy(PostReport $postreport)
    {
        return $postreport->delete();
    }
}
