<?php

class CitiesController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Cities::where('name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Cities::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'cities/index',array('data'=>$data));
	}

	public function getAdd(){
		$regions = Regions::all();
		return View::make('home/dashboard',array())->nest('content', 'cities/add',array('regions'=>$regions));
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$Cities = Cities::find($id);
			$Cities->name = Input::get('name');
			$Cities->postal_code = Input::get('postal_code');
			$Cities->province_id =  Input::get('province_id');
			$Cities->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$Cities = new Cities;
			$Cities->name = Input::get('name');
			$Cities->postal_code = Input::get('postal_code');
			$Cities->province_id =  Input::get('province_id');
			$Cities->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('cities');
	}

	public function getShow($id){
		$data = Cities::find($id);
		return View::make('home/dashboard',array())->nest('content', 'Cities/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Cities::find($id);
		$regions = Regions::all();
		$country = Countries::where('region_id','=',$data->province->country->region->id)->get();
		$province = Provinces::where('country_id', '=', $data->province->country->id)->get();
		$options = array(
			'data'=>$data,
			'regions'=>$regions,
			'country'=>$country,
			'province'=>$province
		);
		return View::make('home/dashboard',array())->nest('content', 'Cities/edit',$options);
	}

	public function getDelete($id){
		$Cities = Cities::find($id);
		$Cities->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('cities');
	}

	public function getCountry($id){
		$country = Countries::where('region_id', '=', $id)->get();
		$html = '<option></option>';
		foreach ($country as $c) {
			$html.= "<option value='".$c->id."'>".$c->name."</option>";
		}
		echo $html;
	}

	public function getProvince($id){
		$province = Provinces::where('country_id', '=', $id)->get();
		$html = '<option></option>';
		foreach ($province as $p) {
			$html.= "<option value='".$p->id."'>".$p->name."</option>";
		}
		echo $html;
	}

}