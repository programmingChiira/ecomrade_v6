<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalCategoryResource;
use Illuminate\Http\Request;
use App\Models\RentalCategory;
use App\Models\RentalSubCategory;

class RentalCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:rental_categories',
        ]);
        $name = $request->input('name');
        $rentalcategory = new RentalCategory();
        $rentalcategory->name = $name;

        return $rentalcategory->save();
    }

    public function index()
    {
        // $rentalcategories = RentalCategory::get();
        // return RentalCategoryResource::collection($rentalcategories);
        //return RentalCategory::latest()->get();
        return RentalCategoryResource::collection(RentalCategory::latest()->get());
    }

    public function getSub()
    {
        return RentalCategory::latest()->get();
    }

    public function show(RentalCategory $rentalcategory)
    {
        return $rentalcategory;
    }

    public function update(Request $request, RentalCategory $rentalcategory)
    {
        $request->validate([
            'name' => 'required | unique:rental_categories',
        ]);

        $name = $request->input('name');
        $rentalcategory->name = $name;

        return $rentalcategory->save();
    }
    
    public function destroy(RentalCategory $rentalcategory)
    {
        return $rentalcategory->delete();
    }
}
