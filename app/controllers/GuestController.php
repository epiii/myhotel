<?php

class GuestController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = guest::where('full_name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = guest::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'guest/index',array('data'=>$data));
	}

	public function getAdd(){
		$options = array(
			'regions'=>Regions::all(),
			'identity'=>Identity::all(),
			'job'=>Jobs::all()
		);
		return View::make('home/dashboard',array())->nest('content', 'guest/add',$options);
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$guest = guest::find($id);
			$guest->identity_id = Input::get('identity_id');
			$guest->job_id = Input::get('job_id');
			$guest->identity_number = Input::get('identity_number');
			$guest->full_name = Input::get('full_name');
			$guest->gender = Input::get('gender');
			$guest->email = Input::get('email');
			$guest->phone = Input::get('phone');
			$guest->city_id = Input::get('city_id');
			$guest->address = Input::get('address');
			$guest->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$guest = new guest;
			$guest->identity_id = Input::get('identity_id');
			$guest->job_id = Input::get('job_id');
			$guest->identity_number = Input::get('identity_number');
			$guest->full_name = Input::get('full_name');
			$guest->gender = Input::get('gender');
			$guest->email = Input::get('email');
			$guest->phone = Input::get('phone');
			$guest->city_id = Input::get('city_id');
			$guest->address = Input::get('address');
			$guest->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('guest');
	}

	public function getShow($id){
		$data = guest::find($id);
		return View::make('home/dashboard',array())->nest('content', 'guest/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = guest::find($id);
		$regions = Regions::all();
		$country = Countries::where('region_id','=',$data->city->province->country->region->id)->get();
		$province = Provinces::where('country_id', '=', $data->city->province->country->id)->get();
		$city = Cities::where('province_id', '=', $data->city->province->id)->get();
		$options = array(
			'data'=>$data,
			'regions'=>$regions,
			'country'=>$country,
			'province'=>$province,
			'city'=>$city,
			'identity'=>Identity::all(),
			'job'=>Jobs::all()
		);
		return View::make('home/dashboard',array())->nest('content', 'guest/edit',$options);
	}

	public function getDelete($id){
		$guest = guest::find($id);
		$guest->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('guest');
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

	public function getCity($id){
		$city = Cities::where('province_id', '=', $id)->get();
		$html = '<option></option>';
		foreach ($city as $c) {
			$html.= "<option value='".$c->id."'>".$c->name."</option>";
		}
		echo $html;
	}

}