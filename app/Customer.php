<?php

namespace App;

use App\Notifications\CustomerResetPassword;
use App\Scopes\OrderBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;

    private $guard_name = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'con_number', 'is_verified','fcm_token', 'jwt_token'
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
    protected $casts = ['is_verified' => 'boolean'];

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

    public function cars()
    {
        return $this->belongsToMany('App\Car')->withPivot('millage', 'vehicle_no', 'insurance', 'year', 'removed_at')->where('removed_at',NULL)->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany('App\CustomerAddress');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function queries()
    {
        return $this->hasMany('App\CustomerQuery');
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
