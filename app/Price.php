<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Location;
use App\Item;

class Price extends Model
{
    protected $fillable = ['location_id', 'item_id', 'user_id', 'value'];

    // $price->user->name
    // N - 1
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // $price->location->name
    // N - 1
    public function location()
    {
    	return $this->belongsTo(Location::class)->withTrashed();
    }

    // $price->item->name
    // N - 1
    public function item()
    {
        //->withTrashed() Tiene en cuenta relaciones que tengan SoftDeleted
    	return $this->belongsTo(Item::class)->withTrashed();
    }

}
