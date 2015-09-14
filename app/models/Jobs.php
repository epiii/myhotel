<?php

class Jobs extends Eloquent{

	protected $table = 'jobs';

	public function employee(){
        return $this->hasMany('Employee');
    }

    public function guest(){
        return $this->hasMany('Guest');
    }

}