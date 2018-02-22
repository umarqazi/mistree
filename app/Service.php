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
        'name', 'parent_id', 'status', 'image', 'loyalty_points', 
    ];


    public function workshops()
    {
        return $this->belongsToMany('App\Workshop');
    }

    // public function parent($parent_id) {
        // return Service::find($parent_id);
    // }

    // public function parent() {
    //     return $this->belongsTo('Service','parent_id');
    // }

    // public function children()
    //     {
    //         return $this->hasMany('Service', 'parent_id');
    //     }

}
