<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'make', 'model', 'picture'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function customers()
    {
        return $this->belongsToMany('App\Customer')->withPivot('millage', 'vehicle_no', 'insurance', 'year', 'removed_at')->withTimestamps();
    }
}
