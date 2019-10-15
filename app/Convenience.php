<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class Convenience extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    //relationship
    public function room()
    {
        return $this->belongsToMany(Room::class, 'room_convenience');
    }
}
