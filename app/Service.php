<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'parent_id', 'status', 'image', 'loyalty_points'
    ];

    public function workshopspecialty()
    {
        return $this->hasOne('App\WorkshopSpecialty');
    }
}
