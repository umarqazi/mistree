<?php

namespace App;

use App\Notifications\WorkshopResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

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
     * The attributes that should be mutated to boolean.
     *
     * @var array
     */
    protected $casts = ['is_approved' => 'boolean', 'is_verified' => 'boolean'];

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
    //    Returns sum of the workshop
    public function sumOfServiceRates($workshop)
    {
        $sum = array_sum($workshop->services->pluck('pivot')->pluck('service_rate')->toArray());
        return $sum;
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

    public static function get_workshop_by_service($service_name)
    {
        $workshop_ids = Db::table('workshop_service')->join('services', 'workshop_service.service_id', '=', 'services.id')->select('workshop_service.workshop_id')->where('services.name', 'LIKE', '%'.$service_name.'%')->get()->pluck('workshop_id')->toArray();
        return $workshop_ids;
    }

}

