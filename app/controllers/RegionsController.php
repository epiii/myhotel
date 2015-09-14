<?php

class RegionsController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Regions::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Regions::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'regions/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'regions/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$regions = Regions::find($id);
			$regions->name = Input::get('name');
			$regions->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$regions = new Regions;
			$regions->name = Input::get('name');
			$regions->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('regions');
	}

	public function getShow($id){
		$data = Regions::find($id);
		return View::make('home/dashboard',array())->nest('content', 'regions/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Regions::find($id);
		return View::make('home/dashboard',array())->nest('content', 'regions/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$regions = Regions::find($id);
		$regions->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('regions');
	}

}