<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Price;
use Carbon\Carbon;

class MonitorController extends Controller
{
    public function index(Request $request)
    {
    	$search = $request->input('search');
    	//if ($request->has('search')) {
    	if ($search) {
    		$query = '%' . $search . '%';
    		$items = Item::where('name', 'like', $query)->orderBy('name')->paginate(5);
    	} else {
    		$items = Item::paginate(5);
    	}
    	
    	$endDate = Carbon::now();
    	$startDate = Carbon::now()->subDays(7);

    	$itemId = $request->input('item_id');
    	if ($itemId) {
			$prices = Price::where('item_id', $itemId)
		    				->whereBetween('created_at', [$startDate, $endDate])
		    				->get();    		
    	} else {
    		$prices = [];
    	}

    	return view('monitor.index', compact('items', 'search', 'prices', 'startDate', 'endDate', 'itemId'));    	
    }
}
