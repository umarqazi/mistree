<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkshopLedger extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id', 'amount', 'transaction_type', 'booking_id', 'adjusted_balance', 'unadjusted_balance'
    ];

    public function workshop()
   {
       return $this->belongsTo('App\Workshop');
   }

    public function transactions()
    {
        return $this->hasMany('App\WorkshopLedger', 'transaction_parent');
    }

    public function children()
    {
        return $this->transactions()->with('children');
    }

    public function parent()
    {
        return $this->belongsTo('App\WorkshopLedger', 'transaction_parent');
    }
}
