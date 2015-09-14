<?php

class IdentityController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = identity::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = identity::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'identity/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'identity/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$identity = Identity::find($id);
			$identity->name = Input::get('name');
			$identity->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$identity = new Identity;
			$identity->name = Input::get('name');
			$identity->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('identity');
	}

	public function getShow($id){
		$data = Identity::find($id);
		return View::make('home/dashboard',array())->nest('content', 'identity/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Identity::find($id);
		return View::make('home/dashboard',array())->nest('content', 'identity/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$identity = Identity::find($id);
		$identity->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('identity');
	}

}