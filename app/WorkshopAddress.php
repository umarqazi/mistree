<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkshopAddress extends Model
{	
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id', 'shop', 'building', 'street', 'block', 'town', 'city', 'coordinates'
    ];

    /**
     * Get the user that owns the phone.
     */   
    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }
}
