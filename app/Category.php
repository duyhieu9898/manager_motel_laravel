<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

/**
 *Get instance category by name
 * @param string $name
 *  return instance query builder
 */
    public function scopeOfName($query, $name)
    {
        return $query->where('name', $name);
    }
}
