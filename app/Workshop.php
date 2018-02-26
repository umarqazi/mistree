<?php

namespace App;

use App\Notifications\WorkshopResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Workshop extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'owner_name', 'email', 'password', 'cnic', 'cnic_image', 'mobile', 'landline', 'type', 'profile_pic', 'open_time', 'close_time', 'is_approved', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the phone record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\WorkshopAddress');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service', 'workshop_service')->withPivot('id', 'service_rate', 'service_time')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function images()
    {
        return $this->hasMany('App\WorkshopImages');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new WorkshopResetPassword($token));
    }

    public function billings()
    {
        return $this->hasMany('App\Billing');
    }

    public function balance(){
        return $this->hasOne('App\WorkshopBalance');       
    }

    public function transactions()
    {
        return $this->hasMany('App\WorkshopLedger');
    }
}

