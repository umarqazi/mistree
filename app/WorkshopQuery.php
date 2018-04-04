<?php

namespace App;

use App\Scopes\OrderBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class WorkshopQuery extends Model
{

	use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id', 'subject', 'message', 'status', 'is_resolved'
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

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
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
