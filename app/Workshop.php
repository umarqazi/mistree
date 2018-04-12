<?php

namespace App;

use App\Notifications\WorkshopResetPassword;
use App\Scopes\OrderBy;
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
        'name', 'owner_name', 'email', 'password', 'cnic', 'cnic_image', 'mobile', 'landline', 'type', 'profile_pic',
        'open_time', 'close_time', 'is_approved', 'is_verified', 'workshopId','fcm_token'
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
     * The attributes that should be appended by default.
     *
     * @var array
     */
    protected $appends  = ['rating'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrderBy);
    }

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

    public function selectedServices($query, $name)
    {
        return $this->services()->where($query, 'LIKE', $name);
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function queries()
    {
        return $this->hasMany('App\WorkshopQuery');
    }

    public function images()
    {
        return $this->hasMany('App\WorkshopImages');
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

    public function getRatingAttribute()
    {
        return round($this->billings()->avg('ratings'), 1);
    }

    //    Returns sum of the workshop
    public function sumOfServiceRates($workshop)
    {
        $sum = array_sum($workshop->services->pluck('pivot')->pluck('service_rate')->toArray());
        return $sum;
    }

    public static function get_workshop_by_service($workshops, $service_name)
    {
        $services = explode(',', $service_name);
        $services = array_map('trim', $services);
        $workshops = $workshops->with(['services' => function($query) use ($services) {
            foreach($services as $key => $service_name){
                if($key == 0)
                    $query->where('services.name', 'LIKE', '%'.$service_name.'%');
                else
                    $query->orwhere('services.name', 'LIKE', '%'.$service_name.'%');
            }
            return $query;
        }]);
        foreach ($services as $service) {
            $workshops->whereHas('services', function($query) use ($service){
                $query->where('services.name', 'LIKE', '%'.$service.'%');
            });
        }
        return $workshops;
    }

    public static function get_workshop_by_service_ids($workshops, $service_ids)
    {
        $services = explode(',', $service_ids);
        $services = array_map('trim', $services);
        $workshops = $workshops->with(['services' => function($query) use ($services) {
            foreach($services as $key => $service_id){
                if($key == 0)
                    $query->where('services.id', '=', $service_id);
                else
                    $query->orWhere('services.id', '=', $service_id);
            }
            return $query;
        }]);
        foreach ($services as $service_id) {
            $workshops->whereHas('services', function($query) use ($service_id){
                $query->where('services.id', '=', $service_id);
            });
        }
        return $workshops;
    }
    public static function get_workshop_by_address($workshops, $key, $value)
    {
        $workshops = $workshops->whereHas('address', function($query) use ($key, $value) {
            $query->where($key, 'LIKE', '%'.$value.'%');
            return $query;
        });
        return $workshops;
    }
    public static function get_workshop_by_customer_addresses($workshops, $customer_addresses)
    {
            return $workshops->whereHas('address', function ($query) use ($customer_addresses){
                return $query->whereIn( 'town', $customer_addresses->pluck('town')->toArray())->whereIn('city', $customer_addresses->pluck('city')->toArray());
            });
    }

    public static function workshops_with_balance($workshops)
    {
        $workshops = $workshops->whereHas('balance', function($query) {
            return $query->where('balance', '>', 30);
        });
        return $workshops;
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
}

