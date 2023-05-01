<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketCategory;

class HomeMarketCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:categories',
        ]);

        $name = $request->input('name');
        $category = new MarketCategory();
        $category->name = $name;

        return $category->save();
    }

    public function index()
    {
        return MarketCategory::latest()->get();
    }

    public function show(MarketCategory $category)
    {
        return $category;
    }

    public function update(Request $request, MarketCategory $category)
    {
        if (auth()->user()->id != $category->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        $request->validate([
            'name' => 'required | unique:categories',
        ]);

        $name = $request->input('name');
        $category->name = $name;

        return $category->save();
    }

    public function destroy(MarketCategory $category)
    {
        if (auth()->user()->id != $category->user->id || auth()->user()->id != 1 ) {
            return abort(403);
        }
        return $category->delete();
    }
}