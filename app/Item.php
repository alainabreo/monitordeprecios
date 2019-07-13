<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name'];

    public function lowestValue($startDate, $endDate)
    {
    	return Price::where('item_id', $this->id)
    				->whereBetween('created_at', [$startDate, $endDate])
    				->min('value');
    }
}
