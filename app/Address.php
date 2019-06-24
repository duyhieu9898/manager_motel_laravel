<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {
	//
	public $timestamps = false;
	protected $table = 'address';
	protected $fillable = ['provincial'];

	//relationship
	public function addresstable() {
		return $this->morphTo();
	}

}
