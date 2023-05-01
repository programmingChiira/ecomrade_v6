<?php

namespace App\Http\Controllers;
use App\Http\Resources\MarketSubCategoryResource;
use Illuminate\Http\Request;
use App\Models\MarketSubCategory;

class MarketSubCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:market_sub_categories',
        ]);

        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $marketsubcategory = new MarketSubCategory();
        $marketsubcategory->name = $name;
        $marketsubcategory->category_id = $category_id;

        return $marketsubcategory->save();
    }

    public function index()
    {
        // $category_id = request('category_id');
        // // return $category_id;

        // $marketsubcategories = MarketSubCategory::where('category_id',$category_id)->get();
        // return MarketSubCategoryResource::collection($marketsubcategories);


        //return MarketSubCategory::latest()->get();

        $name = request('name');
        // return $name;

        $sections = MarketSubCategory::where('category_id',$name)->get();
        return MarketSubCategoryResource::collection($sections);
    }

    public function getSub()
    {
        return MarketSubCategory::latest()->get();
    }

    public function show(MarketSubCategory $marketsubcategory)
    {
        return $marketsubcategory;
    }

    public function update(Request $request, MarketSubCategory $marketsubcategory)
    {
        $request->validate([
            'name' => 'required | unique:market_sub_categories',
        ]);

        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $marketsubcategory->name = $name;
        $marketsubcategory->category_id = $category_id;

        return $marketsubcategory->save();
    }

    public function destroy(MarketSubCategory $marketsubcategory)
    {
        return $marketsubcategory->delete();
    }
}