<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class LocationController extends Controller
{
    public function index()
    {
    	$locations = Location::all();
    	return view('locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
    	Location::create($request->all());
    	return back();
    }

    public function destroy(Location $location)
    {
    	$location->delete();
    	return back();
    }
}
