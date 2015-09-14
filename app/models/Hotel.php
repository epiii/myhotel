<?php

class Hotel extends Eloquent{

	protected $table = 'hotel';

	public function city(){
    	 return $this->belongsTo('Cities');
    }

}