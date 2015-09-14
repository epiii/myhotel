<?php

class BookingServices extends Eloquent{

	protected $table = 'booking_services';

	public function service(){
        return $this->belongsTo('Services');
    }

}