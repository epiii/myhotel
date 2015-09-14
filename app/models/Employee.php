<?php

class Employee extends Eloquent{

	protected $table = 'employee';

	public function city(){
        return $this->belongsTo('Cities');
    }

    public function users(){
        return $this->hasMany('Users');
    }

}