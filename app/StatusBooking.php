<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class StatusBooking extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
