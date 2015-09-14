<?php

class Users extends Eloquent{

	protected $table = 'users';

	public function employee(){
        return $this->belongsTo('Employee');
    }

}