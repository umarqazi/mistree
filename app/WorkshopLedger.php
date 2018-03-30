<?php

namespace App;

use App\Scopes\TransactionsScope;
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TransactionsScope);
    }

    public function workshop()
   {
       return $this->belongsTo('App\Workshop');
   }

    public function adjustments()
    {
        return $this->hasMany('App\WorkshopLedger', 'transaction_parent');
    }

    public function scopeParentLevel($query){
        return $query->where('transaction_parent',0);
    }

}
