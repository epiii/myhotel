<?php

class Bookings extends Eloquent{

	protected $table = 'bookings';

	public function employee(){
        return $this->belongsTo('Employee');
    }

    public function guest(){
        return $this->belongsTo('Guest');
    }

     public function payment(){
        return $this->hasMany('Payments');
    }

}