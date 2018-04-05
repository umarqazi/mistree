<?php

namespace App;

use App\Scopes\OrderBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class CustomerQuery extends Model
{

	use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'subject', 'message', 'status', 'is_resolved'
    ];

    protected $casts = ['is_resolved' => 'boolean'];

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

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function getCreatedAtAttribute($date)
	{
	    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M, Y');
	}

	public function getUpdatedAtAttribute($date)
	{
	    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M, Y');
	}

}
