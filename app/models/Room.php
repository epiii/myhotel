<?php

class Room extends Eloquent{

	protected $table = 'room';

	public function type(){
        return $this->belongsTo('Type');
    }

    public function bookingsrooms(){
        return $this->hasMany('BookingsRooms');
    }

}