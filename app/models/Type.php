<?php

class Type extends Eloquent{

	protected $table = 'type';

	public function room(){
        return $this->hasMany('Room');
    }

}