<?php

class Identity extends Eloquent{

	protected $table = 'identity';

	 public function guest(){
        return $this->hasMany('Guest');
    }

}