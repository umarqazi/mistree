<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerAddress extends Model
{	
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'type', 'house_no', 'street_no', 'block', 'area', 'town', 'city', 'geo_cord', 'status'
    ];

    public function customer()
	{
	    return $this->belongsTo('App\Customer');
	}
}
