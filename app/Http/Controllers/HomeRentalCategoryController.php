<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalCategory;

class HomeRentalCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:categories',
        ]);

        $name = $request->input('name');
        $category = new RentalCategory();
        $category->name = $name;

        return $category->save();
    }

    public function index()
    {
        return RentalCategory::latest()->get();
    }

    public function show(RentalCategory $category)
    {
        return $category;
    }

    public function update(Request $request, RentalCategory $category)
    {
        $request->validate([
            'name' => 'required | unique:categories',
        ]);

        $name = $request->input('name');
        $category->name = $name;

        return $category->save();
    }

    public function destroy(RentalCategory $category)
    {
        return $category->delete();
    }
}