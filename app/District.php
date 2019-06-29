<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    public function addresses()
    {
        return $this->hasMany(Ward::class,'id','district_id');
    }
}
