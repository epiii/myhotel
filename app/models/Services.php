<?php

class Services extends Eloquent{

	protected $table = 'services';

	public function bookingsservices(){
        return $this->hasMany('BookingsServices');
    }

}