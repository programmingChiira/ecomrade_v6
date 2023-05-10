<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = PostResource::collection(Post::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%')
                ->orWhere('post_category', 'like', '%' . $request->search . '%')
                ->latest()->with('postreviews')->paginate(10)->withQueryString());

            $postData = $posts->map(function ($post) {
                $ratings = $post->postReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;

                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'user_id' => $post->user_id,
                    'user_name' => $post->user_name,
                    'post_category' => $post->post_category,
                    'image_1' => $post->image_1,
                    'image_2' => $post->image_2,
                    'image_3' => $post->image_3,
                    'image_4' => $post->image_4,
                    'image_5' => $post->image_5,
                    'body' => $post->body,
                    'club_id' => $post->club_id,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                    'created_at' => $post->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $postData,
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage()
            ]);
        }
        $posts = PostResource::collection(Post::latest()->with('postreviews')->paginate(10));

        $postData = $posts->map(function ($post) {
            $ratings = $post->postReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;

            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'user_id' => $post->user_id,
                'user_name' => $post->user_name,
                'post_category' => $post->post_category,
                'image_1' => $post->image_1,
                'image_2' => $post->image_2,
                'image_3' => $post->image_3,
                'image_4' => $post->image_4,
                'image_5' => $post->image_5,
                'body' => $post->body,
                'club_id' => $post->club_id,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'created_at' => $post->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $postData,
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $title = $request->title;
        $post_category = $request->post_category;

        if (!Post::count()) {
            $postId = 1;
        } else {
            $postId = Post::latest()->first()->id + 1;
        }

        $post = new Post();

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $user_slug = auth()->user()->slug;
        $body = $request->input('body');
        $club_id = $request->input('club_id');

        // create and save post

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $post->image_1 = $image_1;
        }
        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $post->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $post->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $post->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $post->image_5 = $image_5;
        }

        $post->title = $title;
        $post->post_category = $post_category;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->user_name = $user_name;
        $post->user_slug = $user_slug;
        $post->body = $body;
        $post->club_id = $club_id;
        $post->save();
    }

    public function club_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $title = $request->title;
        $post_category = $request->post_category;

        if (!Post::count()) {
            $postId = 1;
        } else {
            $postId = Post::latest()->first()->id + 1;
        }

        $post = new Post();

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = auth()->user()->id;
        $user_name = $request->input('club_name');
        $user_slug = auth()->user()->slug;
        $body = $request->input('body');
        $club_id = $request->input('club_id');

        // create and save post

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $post->image_1 = $image_1;
        }
        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $post->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $post->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $post->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $post->image_5 = $image_5;
        }

        $post->title = $title;
        $post->post_category = $post_category;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->user_name = $user_name;
        $post->user_slug = $user_slug;
        $post->body = $body;
        $post->club_id = $club_id;
        $post->save();
    }
    public function show(Post $post)
    {
        //return new PostResource($post);

        $posts = Post::find($post->id);
        $data = [
            "data" => $posts,
            "avg_rate" => $posts->average_rating,
            "comment_count" => $posts->count_comment,
        ];

        return response()->json($data);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'post_category' => 'required'
        ]);

        $title = $request->title;
        $post_category = $request->post_category;


        $slug = Str::slug($title, '-') . '-' . $post->id;
        $body = $request->input('body');

        if ($request->file('file1')) {
            $image1 = $request->file('file1');
            $image_1 = $request->file('file1')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image1->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_1);
            $post->image_1 = $image_1;
        }

        if ($request->file('file2')) {
            $image2 = $request->file('file2');
            $image_2 = $request->file('file2')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image2->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_2);
            $post->image_2 = $image_2;
        }

        if ($request->file('file3')) {
            $image3 = $request->file('file3');
            $image_3 = $request->file('file3')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image3->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_3);
            $post->image_3 = $image_3;
        }

        if ($request->file('file4')) {
            $image4 = $request->file('file4');
            $image_4 = $request->file('file4')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image4->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_4);
            $post->image_4 = $image_4;
        }

        if ($request->file('file5')) {
            $image5 = $request->file('file5');
            $image_5 = $request->file('file5')->store('');
            $destinationPath = public_path('img/blog');
            $img = Image::make($image5->getRealPath());
            $img->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_5);
            $post->image_5 = $image_5;
        }

        // create and save post
        $post->title = $title;
        $post->post_category = $post_category;
        $post->slug = $slug;
        $post->body = $body;
        return $post->save();
    }

    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
