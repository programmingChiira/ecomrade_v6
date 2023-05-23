<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketCategoryResource;
use Illuminate\Http\Request;
use App\Models\MarketCategory;
use App\Models\MarketSubCategory;

class MarketCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:market_categories',
        ]);
        $name = $request->input('name');
        $marketcategory = new MarketCategory();
        $marketcategory->name = $name;

        return $marketcategory->save();
    }

    public function index()
    {
        return MarketCategoryResource::collection(MarketCategory::latest()->get());
    }

    public function getSub()
    {
        return MarketCategory::latest()->get();
    }

    public function show(MarketCategory $marketcategory)
    {
        return $marketcategory;
    }

    public function update(Request $request, MarketCategory $marketcategory)
    {
        $request->validate([
            'name' => 'required | unique:market_categories',
        ]);

        $name = $request->input('name');
        $marketcategory->name = $name;

        return $marketcategory->save();
    }

    public function destroy(MarketCategory $marketcategory)
    {
        return $marketcategory->delete();
    }
}
