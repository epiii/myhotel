<?php

class BookingRooms extends Eloquent{

	protected $table = 'booking_rooms';

	public function room(){
        return $this->belongsTo('Room');
    }

}