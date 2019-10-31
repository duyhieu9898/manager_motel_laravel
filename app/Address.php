<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
use App\User;
use App\Ward;
use App\District;
use App\Province;

class Address extends Model
{
    //
    public $timestamps = false;
    protected $table = 'addresses';
    protected $fillable = ['street', 'ward_id', 'district_id', 'province_id'];

    //relationship
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
