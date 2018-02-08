<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cust_id', 'ws_id','admin_id', 'type', 'house_no', 'street_no', 'block', 'area', 'town', 'city', 'geo_cord', 'status',
    ];

}