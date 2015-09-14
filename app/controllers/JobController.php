<?php

class JobController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Jobs::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Jobs::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'job/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'job/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$job = Jobs::find($id);
			$job->name = Input::get('name');
			$job->max_salary = Input::get('max_salary');
			$job->min_salary = Input::get('min_salary');
			$job->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$job = new Jobs;
			$job->name = Input::get('name');
			$job->max_salary = Input::get('max_salary');
			$job->min_salary = Input::get('min_salary');
			$job->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('job');
	}

	public function getShow($id){
		$data = Jobs::find($id);
		return View::make('home/dashboard',array())->nest('content', 'job/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Jobs::find($id);
		return View::make('home/dashboard',array())->nest('content', 'job/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$job = Jobs::find($id);
		$job->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('job');
	}

}