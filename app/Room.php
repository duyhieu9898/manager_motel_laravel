<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = true;
    protected $guarded = [];//all attributes mass assignable
    protected $searchable = [
        'title',
    ];
    //relationship
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    public function conveniences()
    {
        return $this->belongsToMany('App\Convenience');
    }
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function statusBooking()
    {
        return $this->belongsTo('App\StatusBooking');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')
                ->withPivot('arrival_date', 'departure_date', 'peoples', 'status_id')
                ->withTimestamps();
    }
}
