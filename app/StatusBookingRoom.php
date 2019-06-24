<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class StatusBookingRoom extends Model {
	//
	protected $table = 'status_booking_room';
	public $timestamps = false;
	protected $fillable = ['name'];

	public function rooms() {
		return $this->hasMany(Room::class);
	}
}
