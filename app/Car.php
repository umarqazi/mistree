<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'maker', 'model', 'year', 'status', 'picture'
    ];

    // protected $fillable = [
    //     'type', 'maker', 'model', 'year', 'status', 'picture'
    // ];
    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }
}
