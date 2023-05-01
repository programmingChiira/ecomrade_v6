<?php

namespace App\Http\Controllers;

use App\Http\Resources\YearResource;
use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\MarketSubCategory;

class YearController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required | unique:years',
        ]);
        $year_no = $request->input('year');
        $year = new Year();
        $year->year = $year_no;

        return $year->save();
    }

    public function index()
    {
        // $marketcategories = Year::get();
        // return YearResource::collection($marketcategories);
        //return Year::latest()->get();
        return YearResource::collection(Year::latest()->get());
    }

    public function getSub()
    {
        return Year::latest()->get();
    }

    public function show(Year $year)
    {
        return $year;
    }

    public function update(Request $request, Year $year)
    {
        $request->validate([
            'year' => 'required | unique:years',
        ]);

        $year_no = $request->input('year');
        $year->year = $year_no;

        return $year->save();
    }
    
    public function destroy(Year $year)
    {
        return $year->delete();
    }
}
