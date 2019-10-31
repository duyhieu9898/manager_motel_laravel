<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicInformation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'content'];
}
