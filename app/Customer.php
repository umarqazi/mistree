<?php

namespace App;

use App\Notifications\CustomerResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    private $guard_name = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'con_number', 'status', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cars()
    {
        return $this->belongsToMany('App\Car')->withPivot('millage', 'vehicle_no', 'insurance', 'removed_at', 'status')->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany('App\CustomerAddress');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function billings()
    {
        return $this->hasMany('App\Billing');
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token));
    }
}
