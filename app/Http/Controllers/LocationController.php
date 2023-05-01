<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\MarketSubCategory;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:locations',
        ]);
        $name = $request->input('name');
        $location = new Location();
        $location->name = $name;

        return $location->save();
    }

    public function index()
    {
        // $marketcategories = Location::get();
        // return LocationResource::collection($marketcategories);
        //return Location::latest()->get();
        return LocationResource::collection(Location::latest()->get());
    }

    public function getSub()
    {
        return Location::latest()->get();
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        if (auth()->user()->id != 1) {
            return abort(403);
        }
        $request->validate([
            'name' => 'required | unique:locations',
        ]);

        $name = $request->input('name');
        $location->name = $name;

        return $location->save();
    }
    
    public function destroy(Location $location)
    {
        if (auth()->user()->id != 1) {
            return abort(403);
        }
        return $location->delete();
    }
}
