<?php

class CountriesController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = countries::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = countries::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'countries/index',array('data'=>$data));
	}

	public function getAdd(){
		$regions = Regions::all();
		return View::make('home/dashboard',array())->nest('content', 'countries/add',array('regions'=>$regions));
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$countries = countries::find($id);
			$countries->name = Input::get('name');
			$countries->region_id =  Input::get('region_id');
			$countries->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$countries = new countries;
			$countries->name = Input::get('name');
			$countries->region_id =  Input::get('region_id');
			$countries->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('countries');
	}

	public function getShow($id){
		$data = countries::find($id);
		return View::make('home/dashboard',array())->nest('content', 'countries/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = countries::find($id);
		$regions = Regions::all();
		$country = Countries::where('region_id','=',$data->region->id)->get();
		$options = array(
			'data'=>$data,
			'regions'=>$regions,
			'country'=>$country,
		);
		return View::make('home/dashboard',array())->nest('content', 'countries/edit',$options);
	}

	public function getDelete($id){
		$countries = countries::find($id);
		$countries->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('countries');
	}

	public function getCountry($id){
		$country = Countries::where('region_id', '=', $id)->get();
		$html = '<option></option>';
		foreach ($country as $c) {
			$html.= "<option value='".$c->id."'>".$c->name."</option>";
		}
		echo $html;
	}

}