<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostReviewResource;
use Illuminate\Http\Request;
use App\Models\PostReview;
use Illuminate\Support\Facades\DB;

class PostReviewController extends Controller
{
    public function store(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $senderName = $request->input('senderName');
        $senderId = $request->input('senderId');
        $userId = $request->input('userId');
        $postId = $request->input('postId');
        $postName = $request->input('postName');
        $postCat = $request->input('postCat');
        $comment = $request->input('comment');

        $postreview = new PostReview();

        $postreview->ratingValue = $ratingValue;
        $postreview->senderName = $senderName;
        $postreview->senderId = $senderId;
        $postreview->userId = $userId;
        $postreview->postId = $postId;
        $postreview->postName = $postName;
        $postreview->postCat = $postCat;
        $postreview->comment = $comment;

        return $postreview->save();
    }

    public function index()
    {
        // $postcategories = PostReview::get();
        // return PostReviewResource::collection($postcategories);
        //return PostReview::latest()->get();
        return PostReviewResource::collection(PostReview::latest()->get());
    }

     public function getSub()
    {
        return PostReview::latest()->get();
    }

    public function show(PostReview $postreview)
    {
        return $postreview;
    }

    public function update(Request $request, PostReview $postreview)
    {
        $request->validate([
            'name' => 'required | unique:post_reviews',
        ]);

        $name = $request->input('name');
        $postreview->name = $name;

        return $postreview->save();
    }

    public function destroy(PostReview $postreview)
    {
        return $postreview->delete();
    }
}
