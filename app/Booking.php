<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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

    protected $casts = ['is_accepted' => 'boolean'];
    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service')->withPivot('name', 'service_rate', 'service_time')->withTimestamps();
    }

    public function billing()
    {
        return $this->hasOne('App\Billing');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }


}
