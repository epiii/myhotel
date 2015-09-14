<?php

class ProvincesController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = provinces::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = provinces::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'provinces/index',array('data'=>$data));
	}

	public function getAdd(){
		$regions = Regions::all();
		return View::make('home/dashboard',array())->nest('content', 'provinces/add',array('regions'=>$regions));
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$provinces = provinces::find($id);
			$provinces->name = Input::get('name');
			$provinces->country_id =  Input::get('country_id');
			$provinces->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$provinces = new provinces;
			$provinces->name = Input::get('name');
			$provinces->country_id = Input::get('country_id');
			$provinces->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('provinces');
	}

	public function getShow($id){
		$data = provinces::find($id);
		return View::make('home/dashboard',array())->nest('content', 'provinces/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = provinces::find($id);
		$regions = Regions::all();
		$country = Countries::where('region_id','=',$data->country->region->id)->get();
		$options = array(
			'data'=>$data,
			'regions'=>$regions,
			'country'=>$country,
		);
		return View::make('home/dashboard',array())->nest('content', 'provinces/edit',$options);
	}

	public function getDelete($id){
		$provinces = provinces::find($id);
		$provinces->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('provinces');
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