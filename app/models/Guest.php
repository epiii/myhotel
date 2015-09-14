<?php

class Guest extends Eloquent{

	protected $table = 'guest';

	public function identity(){
    	 return $this->belongsTo('Identity');
    }

    public function job(){
    	 return $this->belongsTo('Jobs');
    }

     public function city(){
    	 return $this->belongsTo('Cities');
    }

}