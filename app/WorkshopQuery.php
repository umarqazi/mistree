<?php

namespace App;

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
        'workshop_id', 'subject', 'message', 'status'
    ];

    protected $cast = ['is_resolved' => 'boolean'];

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
