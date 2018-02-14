<?php

namespace App;

use App\Notifications\WorkshopResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Workshop extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'card_number', 'con_number', 'type', 'profile_pic', 'pic1', 'pic2', 'pic3', 'geo_cord', 'team_slot', 'open_time', 'close_time','status', 'is_verified', 'owner_name', 'cnic_image'
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */

    /**
     * Get the phone record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\WorkshopAddress');
    }

    public function specialty()
    {
        return $this->hasMany('App\WorkshopSpecialty');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new WorkshopResetPassword($token));
    }
}
