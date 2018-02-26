<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'service_parent', 'loyalty_points', 'image'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function workshops()
    {
        return $this->belongsToMany('App\Workshop', 'workshop_service');
    }

    public function bookings()
    {
        return $this->belongsToMany('App\Booking');
    }

    public function services()
    {
        return $this->hasMany('App\Service', 'service_parent');
    }

}
