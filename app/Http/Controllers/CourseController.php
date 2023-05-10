<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\MarketSubCategory;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:courses',
        ]);
        $name = $request->input('name');
        $course = new Course();
        $course->name = $name;

        return $course->save();
    }

    public function index()
    {
        // $marketcategories = Course::get();
        // return CourseResource::collection($marketcategories);
        //return Course::latest()->get();
        return CourseResource::collection(Course::latest()->get());
    }

    public function getSub()
    {
        return Course::latest()->get();
    }

    public function show(Course $course)
    {
        return $course;
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required | unique:courses',
        ]);

        $name = $request->input('name');
        $course->name = $name;

        return $course->save();
    }
    
    public function destroy(Course $course)
    {
        return $course->delete();
    }
}
