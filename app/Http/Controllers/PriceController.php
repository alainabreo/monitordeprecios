<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Price;
use App\Item;

use App\Exports\PricesExport;
use Excel;

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

	public function destroy(Price $price)
	{
		$price->delete();
		return back();
	}

	public function export(Item $item, $startDate, $endDate) 
    {
    	$fileName = "Detalles del Item $item->name.xlsx";
    	$export = new PricesExport($item->id, $startDate, $endDate);

        return Excel::download($export, $fileName);
    }
}
