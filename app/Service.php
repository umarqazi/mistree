<?php

namespace App;

use App\Scopes\CategoryScope;
use App\Scopes\ServicesScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'service_parent', 'loyalty_points', 'image'
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
    protected $casts = ['is_doorstep' => 'boolean'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CategoryScope);
        static::addGlobalScope(new ServicesScope);
    }

    public function workshops()
    {
        return $this->belongsToMany('App\Workshop', 'workshop_service')->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany('App\Booking')->withPivot('name', 'service_rate', 'service_time', 'loyalty_points', 'lead_charges')->withTimestamps();
    }

    public function services()
    {
        return $this->hasMany('App\Service', 'service_parent');
    }

    public function children()
    {
        return $this->services()->with('children');
    }

    public function parent()
    {
        return $this->belongsTo('App\Service', 'service_parent');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopeParentLevel($query)
    {
        return $query->where('service_parent',0);
    }

    public function scopeHatchback($query){
        $id = Category::select('id')->where('name', 'Hatchback')->first();
        return $query->where('category_id',$id['id']);
    }

    public function scopeSedan($query){
        $id = Category::select('id')->where('name', 'Sedan/Saloon')->first();
        return $query->where('category_id',$id['id']);
    }
    public function scopeLuxury($query){
        $id = Category::select('id')->where('name', 'Luxury Car')->first();
        return $query->where('category_id',$id['id']);
    }

    public function scopeSuv($query){
        $id = Category::select('id')->where('name', 'SUV/4X4')->first();
        return $query->where('category_id',$id['id']);
    }
}
