<?php

class Payments extends Eloquent{

	protected $table = 'payments';

	 public function booking(){
        return $this->belongsTo('Bookings');
    }

}