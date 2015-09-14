<?php

class Regions extends Eloquent{

	protected $table = 'regions';

    public function country(){
        return $this->hasMany('Countries');
    }

}