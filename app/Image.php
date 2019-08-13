<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images'; //auto
    public $timestamps = false;

    //relationship
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
