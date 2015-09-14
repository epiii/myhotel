<?php

class HotelController extends Controller{

	public function getIndex(){
		$hotel = Hotel::find(1);
		$regions = Regions::all();
		$country = Countries::where('region_id','=',$hotel->city->province->country->region->id)->get();
		$province = Provinces::where('country_id', '=', $hotel->city->province->country->id)->get();
		$city = Cities::where('province_id', '=', $hotel->city->province->id)->get();
		$options = array(
			'hotel'=>$hotel,
			'regions'=>$regions,
			'country'=>$country,
			'province'=>$province,
			'city'=>$city,
		);
		return View::make('home/dashboard',array())->nest('content', 'hotel/profile',$options);
	}

	public function getSave(){
		$id = Input::get('id');
		$hotel = Hotel::find($id);
		$hotel->name = Input::get('name');
		$hotel->email = Input::get('email');
		$hotel->phone = Input::get('phone');
		$hotel->city_id = Input::get('city_id');
		$hotel->address = Input::get('address');
		$hotel->save();
		Session::flash('message', 'The records are updated successfully');
		return Redirect::to('hotel');
	}
}