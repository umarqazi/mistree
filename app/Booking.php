<?php

namespace App;

use App\Scopes\BookingScope;
use App\Scopes\OrderBy;
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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderBy);
        static::addGlobalScope(new BookingScope);
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function address()
    {
        return $this->belongsTo('App\CustomerAddress', 'customer_address_id');
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

//  Booking Listing Queries

//  Local Scope functions
    public function scopePendingBookings($query)
    {
        return $query->where('job_status', '=', 'open')->where('is_accepted', false);
    }

    public function scopeActiveBookings($query)
    {
        return $query->where('job_status', '=', 'open')->where('is_accepted', true);
    }

    public function scopeCompletedBookings($query)
    {
        return $query->where('job_status', '=', 'completed')->where('is_accepted', true);
    }

    public function scopeRejectedBookings($query)
    {
        return $query->where('job_status', '=', 'rejected')->where('is_accepted' , false );
    }

    public function scopeAcceptedBookings($query)
    {
        return $query->where('is_accepted' , true);
    }

    public function scopeExpiredBookings($query)
    {
        return $query->where('job_status', '=', 'expired')->where('is_accepted', false);
    }

    public function scopeAcceptedCompletedBookings($query)
    {
        return $query->where('is_accepted', true)->where('job_status', '=', 'completed')->orwhere('job_status', '=', 'accepted');
    }
}
