<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Booking extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'workshop_id', 'customer_car_id', 'job_date', 'job_time', 'is_accepted', 'job_status',
    ];	

    protected $casts = ['is_accepted' => 'boolean', 'is_doorstep' => 'boolean'];
    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function customer_address()
    {
        return $this->hasOne('App\CustomerAddress');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service')->withPivot('name', 'service_rate', 'service_time', 'loyalty_points', 'lead_charges')->withTimestamps();
    }

    public function billing()
    {
        return $this->hasOne('App\Billing');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
  
    public function getJobDateAttribute($date) 
    { 
        return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y'); 
    }


}
