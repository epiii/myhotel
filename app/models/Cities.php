<?php

class Cities extends Eloquent{

	protected $table = 'cities';

	public function province(){
        return $this->belongsTo('Provinces');
    }

    public function employee(){
        return $this->hasMany('Employee');
    }

    public function guest(){
        return $this->hasMany('Guest');
    }

    public function hotel(){
        return $this->hasMany('Hotel');
    }

}