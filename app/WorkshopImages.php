<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopImages extends Model
{
   protected $fillable = [
       'workshop_id','url'
   ];

   public function workshop()
   {
       return $this->belongsTo('App\Workshop');
   }
}
