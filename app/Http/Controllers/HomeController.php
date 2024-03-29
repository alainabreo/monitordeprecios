<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Item;
use App\Price;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $locations = Location::all();
        $items = Item::all();
        //$prices = Price::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(10)->get();
        $prices = Price::where('user_id', auth()->user()->id)->paginate(10);
        return view('home', compact('locations', 'items', 'prices'));
    }
}
