<?php

namespace App;

use App\Address;
use App\Category;
use App\Convenient;
use App\Image;
use App\StatusBooking;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = 'rooms';
    public $timestamps = true;
    protected $guarded = [];//all attributes mass assignable

    //relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function convenients()
    {
        return $this->belongsToMany(Convenient::class, 'room_convenient');
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function statusBooking()
    {
        return $this->belongsTo(statusBooking::class);
    }
    /**
     * function help detach, attack
     *
     * @return eloquent_model
     */
    public function roles()
    {
        return $this->belongsToMany(Convenient::class, 'room_convenient');
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('check_in', 'check_out')->withTimestamps();
    }
}
