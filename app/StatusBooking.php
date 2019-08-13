<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusBooking extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
