<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
    	$search = $request->input('search');
    	//if ($request->has('search')) {
    	if ($search) {
    		$query = '%' . $search . '%';
    		$items = Item::where('name', 'like', $query)->orderBy('name')->paginate(10);
    	} else {
    		$items = Item::paginate(10);
    	}
    	return view('items.index', compact('items', 'search'));
    }

    public function store(Request $request)
    {
    	Item::create($request->all());
    	return back();
    }

    public function destroy(Item $item)
    {
    	$item->delete();
    	return back();
    }
}
