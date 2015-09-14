<?php

class TypeController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Type::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Type::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'Type/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'Type/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$Type = Type::find($id);
			$Type->name = Input::get('name');
			$Type->price = Input::get('price');
			$Type->description = Input::get('description');
			$Type->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$Type = new Type;
			$Type->name = Input::get('name');
			$Type->price = Input::get('price');
			$Type->description = Input::get('description');
			$Type->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('type');
	}

	public function getShow($id){
		$data = Type::find($id);
		return View::make('home/dashboard',array())->nest('content', 'Type/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Type::find($id);
		return View::make('home/dashboard',array())->nest('content', 'Type/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$Type = Type::find($id);
		$Type->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('type');
	}

}