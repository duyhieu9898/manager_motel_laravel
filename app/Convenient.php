<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class Convenient extends Model {
	//
	protected $table = 'convenients'; //auto
	public $timestamps = false;

	//relationship
	public function room() {
		return $this->belongsToMany(Room::class, 'room_convenient');
	}
}
