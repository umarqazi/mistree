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
        return $this->belongsToMany('App\Workshop', 'workshop_service')->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany('App\Booking')->withPivot('name', 'service_rate', 'service_time', 'loyalty_points', 'lead_charges')->withTimestamps();
    }

    public function services()
    {
        return $this->hasMany('App\Service', 'service_parent');
    }

    public function parent($id)
    {
        return $this->find($id)['name'];
    }

}
