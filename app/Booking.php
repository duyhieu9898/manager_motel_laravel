<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'room_id', 'arrival_date', 'departure_date', 'peoples', 'status_id'];
    public function rooms()
    {
        return $this->belongsTo('App\Room');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
