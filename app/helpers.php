<?php

function CekPayments($id){
	$payments = Payments::where('booking_id','=',$id)->first();
	if($payments->cashed==1){
		return true;
	}
	return false;
}

function CountRoom($id){
	$br = BookingRooms::where('booking_id',$id);
	return $br->count();
}

function CountService($id){
	$bs = BookingServices::where('booking_id',$id);
	return $bs->count();
}

function Total($id){
	$payment = Payments::where('booking_id',$id)->first();
	return '$ '.$payment->grand_total;
}

function CountDate($first_date,$last_date){
	$year = date('Y');
	$first_date = $year.'-'.$first_date;
	$last_date = $year.'-'.$last_date;
	$data = Bookings::where('date_booking','>=',$first_date)->where('date_booking','<=',$last_date);
	return $data->count();
}