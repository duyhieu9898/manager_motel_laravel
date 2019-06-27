<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
use App\User;

class Address extends Model
{
    //
    public $timestamps = false;
    protected $table = 'address';
    protected $fillable = ['provincial'];

    //relationship
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
