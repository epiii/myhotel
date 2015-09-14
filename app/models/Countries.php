<?php

class Countries extends Eloquent{

	protected $table = 'countries';

	public function region(){
        return $this->belongsTo('Regions');
    }

    public function province(){
        return $this->hasMany('Provinces');
    }

}