<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Price;

class PriceController extends Controller
{
	public function store(Request $request)
	{
		//$data = $request->all();
		$data['location_id'] = $request->input('location_id');
		$data['item_id'] = $request->input('item_id');
		$data['user_id'] = auth()->user()->id;
		$data['value'] = $request->input('value');

		Price::create($data);
		return back();
	}
}
