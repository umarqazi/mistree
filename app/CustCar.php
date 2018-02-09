<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CustCar extends Model
{
    protected $table="cust_cars";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'maker', 'model', 'year', 'status', 'picture'
    ];
}
