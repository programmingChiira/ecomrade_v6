<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceReviewResource;
use Illuminate\Http\Request;
use App\Models\ResourceReview;
use Illuminate\Support\Facades\DB;

class ResourceReviewController extends Controller
{
    public function store(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $senderName = $request->input('senderName');
        $senderId = $request->input('senderId');
        $userId = $request->input('userId');
        $resourceId = $request->input('resourceId');
        $resourceTitle = $request->input('resourceTitle');
        $comment = $request->input('comment');
        
        $resourcereview = new ResourceReview();

        $resourcereview->ratingValue = $ratingValue;
        $resourcereview->senderName = $senderName;
        $resourcereview->senderId = $senderId;
        $resourcereview->userId = $userId;
        $resourcereview->resourceId = $resourceId;
        $resourcereview->resourceTitle = $resourceTitle;
        $resourcereview->comment = $comment;

        return $resourcereview->save();
    }

    public function index()
    {
        // $resourcecategories = ResourceReview::get();
        // return ResourceReviewResource::collection($resourcecategories);
        //return ResourceReview::latest()->get();
        return ResourceReviewResource::collection(ResourceReview::latest()->get());
    }

     public function getSub()
    {
        return ResourceReview::latest()->get();
    }

    public function show(ResourceReview $resourcereview)
    {
        return $resourcereview;
    }

    public function update(Request $request, ResourceReview $resourcereview)
    {
        $request->validate([
            'name' => 'required | unique:resources_reviews',
        ]);

        $name = $request->input('name');
        $resourcereview->name = $name;

        return $resourcereview->save();
    }

    public function destroy(ResourceReview $resourcereview)
    {
        return $resourcereview->delete();
    }
}
