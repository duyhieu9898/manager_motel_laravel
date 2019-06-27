<?php

namespace App;

use App\Address;
use App\Category;
use App\Convenient;
use App\Image;
use App\StatusBooking;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = 'rooms';
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'police_and_terms', 'price', 'room_area', 'status_booking', 'address_id'];

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
}
