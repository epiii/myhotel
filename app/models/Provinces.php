<?php

class Provinces extends Eloquent{

	protected $table = 'provinces';

	public function country(){
        return $this->belongsTo('Countries');
    }

    public function city(){
        return $this->hasMany('Cities');
    }

}