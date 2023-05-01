<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $resources = ResourceResource::collection(Resource::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('academic_year', 'like', '%' . $request->search . '%')
                ->orWhere('course', 'like', '%' . $request->search . '%')
                ->latest()->with('resourcereviews')->paginate(10)->withQueryString());

            $resourceData = $resources->map(function ($resource) {
                $ratings = $resource->resourceReviews;
                $count = $ratings->count();
                $avgRating = $count ? $ratings->avg('ratingValue') : 0;

                return [
                    'id' => $resource->id,
                    'title' => $resource->title,
                    'slug' => $resource->slug,
                    'user_id' => $resource->user_id,
                    'user_name' => $resource->user_name,
                    'user_slug' => $resource->user_slug,
                    'resource_1' => $resource->resource_1,
                    'resource_2' => $resource->resource_2,
                    'resource_3' => $resource->resource_3,
                    'resource_4' => $resource->resource_4,
                    'resource_5' => $resource->resource_5,
                    'academic_year' => $resource->academic_year,
                    'course' => $resource->course,
                    'club_id' => $resource->club_id,
                    'avg_rating' => $avgRating,
                    'rating_count' => $count,
                    'created_at' => $resource->created_at->diffForHumans(),
                ];
            });

            return response()->json([
                'data' => $resourceData,
                'current_page' => $resources->currentPage(),
                'last_page' => $resources->lastPage()
            ]);
        }
        $resources = ResourceResource::collection(Resource::latest()->with('resourcereviews')->paginate(10));

        $resourceData = $resources->map(function ($resource) {
            $ratings = $resource->resourceReviews;
            $count = $ratings->count();
            $avgRating = $count ? $ratings->avg('ratingValue') : 0;

            return [
                'id' => $resource->id,
                'title' => $resource->title,
                'slug' => $resource->slug,
                'user_id' => $resource->user_id,
                'user_name' => $resource->user_name,
                'user_slug' => $resource->user_slug,
                'resource_1' => $resource->resource_1,
                'resource_2' => $resource->resource_2,
                'resource_3' => $resource->resource_3,
                'resource_4' => $resource->resource_4,
                'resource_5' => $resource->resource_5,
                'academic_year' => $resource->academic_year,
                'course' => $resource->course,
                'club_id' => $resource->club_id,
                'avg_rating' => $avgRating,
                'rating_count' => $count,
                'created_at' => $resource->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'data' => $resourceData,
            'current_page' => $resources->currentPage(),
            'last_page' => $resources->lastPage()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'academic_year' => 'required',
            'course' => 'required',
        ]);
        $title = $request->title;

        if (!Resource::count()) {
            $resourceId = 1;
        } else {
            $resourceId = Resource::latest()->first()->id + 1;
        }

        $resource = new Resource();

        $slug = Str::slug($title, '-') . '-' . $resourceId;
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $user_slug = auth()->user()->slug;
        $academic_year = $request->input('academic_year');
        $course = $request->input('course');
        $club_id = $request->input('club_id');
        $academic_year_update = 'Year ' . $academic_year;


        if ($request->file('file1')) {
            if ($request->file('file1')->isValid()) {
                $originalFileName = $request->file('file1')->getClientOriginalName();
                $extension = $request->file('file1')->getClientOriginalExtension();
                $fileSize = $request->file('file1')->getSize();
                $mimeType = $request->file('file1')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file1 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file1')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_1 = $fileName;
            }
        }

        if ($request->file('file2')) {
            if ($request->file('file2')->isValid()) {
                $originalFileName = $request->file('file2')->getClientOriginalName();
                $extension = $request->file('file2')->getClientOriginalExtension();
                $fileSize = $request->file('file2')->getSize();
                $mimeType = $request->file('file2')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file2 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file2')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_2 = $fileName;
            }
        }

        if ($request->file('file3')) {
            if ($request->file('file3')->isValid()) {
                $originalFileName = $request->file('file3')->getClientOriginalName();
                $extension = $request->file('file3')->getClientOriginalExtension();
                $fileSize = $request->file('file3')->getSize();
                $mimeType = $request->file('file3')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file3 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file3')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_3 = $fileName;
            }
        }

        if ($request->file('file4')) {
            if ($request->file('file4')->isValid()) {
                $originalFileName = $request->file('file4')->getClientOriginalName();
                $extension = $request->file('file4')->getClientOriginalExtension();
                $fileSize = $request->file('file4')->getSize();
                $mimeType = $request->file('file4')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file4 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file4')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_4 = $fileName;
            }
        }

        if ($request->file('file5')) {
            if ($request->file('file5')->isValid()) {
                $originalFileName = $request->file('file5')->getClientOriginalName();
                $extension = $request->file('file5')->getClientOriginalExtension();
                $fileSize = $request->file('file5')->getSize();
                $mimeType = $request->file('file5')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file5 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file5')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_5 = $fileName;
            }
        }

        $resource->title = $title;
        $resource->slug = $slug;
        $resource->user_id = $user_id;
        $resource->user_name = $user_name;
        $resource->user_slug = $user_slug;
        $resource->academic_year = $academic_year_update;
        $resource->course = $course;
        $resource->club_id = $club_id;
        $resource->save();
    }
    public function show(Resource $resource)
    {
        //return new ResourceResource($resource);

        $resources = Resource::find($resource->id);
        $data = [
            "data" => $resources,
            "avg_rate" => $resources->average_rating,
            "comment_count" => $resources->count_comment,
        ];

        return response()->json($data);
    }

    public function update(Request $request, Resource $resource)
    {
        if (auth()->user()->id != $resource->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        $request->validate([
            'title' => 'required',
            'academic_year' => 'required',
            'course' => 'required',
        ]);

        $title = $request->title;

        $slug = Str::slug($title, '-') . '-' . $resource->id;
        $academic_year = $request->input('academic_year');
        $course = $request->input('course');

        if ($request->file('file1')) {
            if ($request->file('file1')->isValid()) {
                $originalFileName = $request->file('file1')->getClientOriginalName();
                $extension = $request->file('file1')->getClientOriginalExtension();
                $fileSize = $request->file('file1')->getSize();
                $mimeType = $request->file('file1')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file1 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file1')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_1 = $fileName;
            }
        }

        if ($request->file('file2')) {
            if ($request->file('file2')->isValid()) {
                $originalFileName = $request->file('file2')->getClientOriginalName();
                $extension = $request->file('file2')->getClientOriginalExtension();
                $fileSize = $request->file('file2')->getSize();
                $mimeType = $request->file('file2')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file2 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file2')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_2 = $fileName;
            }
        }

        if ($request->file('file3')) {
            if ($request->file('file3')->isValid()) {
                $originalFileName = $request->file('file3')->getClientOriginalName();
                $extension = $request->file('file3')->getClientOriginalExtension();
                $fileSize = $request->file('file3')->getSize();
                $mimeType = $request->file('file3')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file3 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file3')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_3 = $fileName;
            }
        }

        if ($request->file('file4')) {
            if ($request->file('file4')->isValid()) {
                $originalFileName = $request->file('file4')->getClientOriginalName();
                $extension = $request->file('file4')->getClientOriginalExtension();
                $fileSize = $request->file('file4')->getSize();
                $mimeType = $request->file('file4')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file4 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file4')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_4 = $fileName;
            }
        }

        if ($request->file('file5')) {
            if ($request->file('file5')->isValid()) {
                $originalFileName = $request->file('file5')->getClientOriginalName();
                $extension = $request->file('file5')->getClientOriginalExtension();
                $fileSize = $request->file('file5')->getSize();
                $mimeType = $request->file('file5')->getClientMimeType();

                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return redirect()->back()->with('error', 'The file5 must be a file of type: pdf, docx, jpeg or png.');
                }

                $uniqueId = uniqid();
                $fileName = $uniqueId . '_' . $originalFileName;

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $destinationPath = public_path('img/resource');
                } else {
                    $destinationPath = public_path('img/resource');
                }

                $request->file('file5')->move($destinationPath, $fileName);

                if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                    $img = Image::make($destinationPath . '/' . $fileName);
                    $img->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $fileName);
                }

                $resource->resource_5 = $fileName;
            }
        }

        // create and save resource
        $resource->title = $title;
        $resource->slug = $slug;
        $resource->academic_year = $academic_year;
        $resource->course = $course;
        return $resource->save();
    }

    public function destroy(Resource $resource)
    {
        if (auth()->user()->id != $resource->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }

        return $resource->delete();
    }
}
