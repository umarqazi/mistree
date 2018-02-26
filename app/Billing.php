<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Billing extends Model
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id', 'booking_id', 'amount', 'customer_id'
    ];

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
    
}
