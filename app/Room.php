<?php

namespace App;

use App\Convenient;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = true;
    protected $guarded = [];//all attributes mass assignable

    //relationship
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    public function convenients()
    {
        return $this->belongsToMany('App\Convenient');
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
                ->withPivot('check_in', 'check_out', 'status_id')
                ->withTimestamps();
    }
}
