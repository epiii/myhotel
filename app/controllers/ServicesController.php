<?php

class ServicesController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Services::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Services::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'services/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'services/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$services = Services::find($id);
			$services->name = Input::get('name');
			$services->price = Input::get('price');
			$services->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$services = new Services;
			$services->name = Input::get('name');
			$services->price = Input::get('price');
			$services->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('services');
	}

	public function getShow($id){
		$data = Services::find($id);
		return View::make('home/dashboard',array())->nest('content', 'services/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Services::find($id);
		return View::make('home/dashboard',array())->nest('content', 'services/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$services = Services::find($id);
		$services->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('services');
	}

}