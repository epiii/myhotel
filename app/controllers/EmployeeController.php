<?php

class EmployeeController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = employee::where('full_name', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = employee::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'employee/index',array('data'=>$data));
	}

	public function Position(){
		$data = Jobs::All();
		$array = array();
		$i = 0;
		foreach($data as $row){
			$array[$i] = $row->name;
			$i++;
		}
		return $array;
	}

	public function getAdd(){
		$regions = Regions::all();
		return View::make('home/dashboard',array())->nest('content', 'employee/add',array('regions'=>$regions,'position'=>$this->Position()));
	}

	public function getSave(){
		$id = Input::get('id');
		if($id){
			$employee = employee::find($id);
			$employee->full_name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->gender = Input::get('gender');
			$employee->phone = Input::get('phone');
			$employee->email = Input::get('email');
			$employee->address = Input::get('address');
			$employee->city_id = Input::get('city_id');
			$employee->save();
			Session::flash('message', 'The records are updated successfully');
		}else{
			$employee = new employee;
			$employee->full_name = Input::get('name');
			$employee->position = Input::get('position');
			$employee->gender = Input::get('gender');
			$employee->phone = Input::get('phone');
			$employee->email = Input::get('email');
			$employee->address = Input::get('address');
			$employee->city_id = Input::get('city_id');
			$employee->save();
			Session::flash('message', 'The records are inserted successfully');
		}
		return Redirect::to('employee');
	}

	public function getShow($id){
		$data = employee::find($id);
		return View::make('home/dashboard',array())->nest('content', 'employee/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = employee::find($id);
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
			'position'=>$this->Position()
		);
		return View::make('home/dashboard',array())->nest('content', 'employee/edit',$options);
	}

	public function getDelete($id){
		$employee = employee::find($id);
		$employee->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('employee');
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