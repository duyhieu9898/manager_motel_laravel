<?php

namespace App\Http\Resources;

use App\Address;

use App\StatusBooking;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\StatusBooking as StatusBookingResource;
use App\Http\Resources\Image as ImageResource;

class Room extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'category'=> $this->category,
            'address' => $this->address,
            'status_booking' => $this->statusBooking,
            'title' => $this->title,
            'description' => $this->description,
            'room_area' => $this->room_area,
            'maximum_peoples_number' => $this->maximum_peoples_number,
            'police_and_terms' => $this->police_and_terms,
            'price' => $this->price,
            'image' => $this->images,
            'conveniences' => $this->conveniences
        ];
    }
}
