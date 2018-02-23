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
        'customer_id', 'workshop_id', 'customer_car_id', 'job_date', 'job_time', 'response', 'job_status',
    ];	

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }


}
