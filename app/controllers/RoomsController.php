<?php

class RoomsController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Room::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Room::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'room/index',array('data'=>$data));
	}

	public function getAdd(){
		$type = Type::all();
		return View::make('home/dashboard',array())->nest('content', 'room/add',array('type'=>$type));
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$room = Room::find($id);
			$room->type_id = Input::get('type_id');
			$room->number = Input::get('number');
			$room->floor =  Input::get('floor');
			$room->name =  Input::get('name');
			$room->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$room = new Room;
			$room->type_id = Input::get('type_id');
			$room->number = Input::get('number');
			$room->floor =  Input::get('floor');
			$room->name =  Input::get('name');
			$room->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('rooms');
	}

	public function getShow($id){
		$data = Room::find($id);
		return View::make('home/dashboard',array())->nest('content', 'room/show',array('data'=>$data));
	}

	public function getEdit($id){
		$type = Type::all();
		$data = Room::find($id);
		return View::make('home/dashboard',array())->nest('content', 'room/edit',array('data'=>$data,'type'=>$type));
	}

	public function getDelete($id){
		$room = Room::find($id);
		$room->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('rooms');
	}

}