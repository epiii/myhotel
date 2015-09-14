<?php

class BookingController extends Controller{

	public function getIndex(){
		$first_date = Input::get('first_date');
		$last_date = Input::get('last_date');
		if(isset($first_date) && isset($last_date)){
			$data = Bookings::where('date_booking','>=',$first_date)->where('date_booking','<=',$last_date)->paginate(10);
		}else{
			$data = Bookings::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'bookings/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'bookings/add',array());
	}

	public function getSave(){

		$id = Input::get('id');
		$year = date('Y');
		$month = date('m');
		$date = date('d');
		$now = date('Y-m-d');
		if($id){
			// print_r($_POST);
			$employee_id = Input::get('employee_id');

			if($employee_id){
				$employee_id = Input::get('employee_id');
			}else{
				$employee_id = NULL;
			}


			$bs = BookingServices::where('booking_id',$id);
			$bs->delete();

			$br = BookingRooms::where('booking_id',$id);
			$br->delete();


			$bookings = Bookings::find($id);
			$service_id = Input::get('service_id');
			$TOTAL = 0;
			for($i=0;$i<count($service_id);$i++){
				$cek_bs = BookingServices::where('service_id','=',$service_id[$i])->first();
				if(empty($cek_bs)){
					$booking_service = new BookingServices;
					$d_service = Services::find($service_id[$i]);
					$booking_service->booking_id = $id;
					$booking_service->service_id = $service_id[$i];
					$booking_service->price = $d_service->price;
					$TOTAL+=$d_service->price;
					$booking_service->save();
				}
			}

			$room_id = Input::get('room_id');
			for($j=0;$j<count($room_id);$j++){
				$cek_r = BookingRooms::where('room_id','=',$room_id[$j])->first();
				if(empty($cek_r)){
					$booking_room = new BookingRooms;
					$d_room = Room::find($room_id[$j]);
					$d_room->booked = 1;
					$booking_room->booking_id = $id;
					$booking_room->room_id = $room_id[$j];
					$booking_room->price = $d_room->type->price;
					$booking_room->save();
					$d_room->save();
					$TOTAL+=$d_room->type->price;
				}
			}

			$bookings->guest_id = Input::get('guest_id');
			$bookings->employee_id = $employee_id;
			$bookings->number_of_days = Input::get('number_of_days');
			$bookings->date_booking = Input::get('date_booking');
			$bookings->date_booking_from = Input::get('date_booking');
			$bookings->date_booking_to = Input::get('date_booking_to');
			$bookings->save();


			$holiday = date('D');
			if($holiday=='Sat'||$holiday=='Sun'){
				$disc = 0.05;
			}else{
				$disc = 0;
			}

			$TOTAL = $TOTAL*$bookings->number_of_days;
			$discount = $TOTAL*$disc;
			$grand_total = $TOTAL - $discount;

			$py = Payments::where('booking_id','=',$id)->first();
			$payment = Payments::find($py->id);
			$payment->subtotal = $TOTAL;
			$payment->disc =$disc;
			$payment->grand_total = $grand_total;
			$payment->cashed = 0;
			$payment->save();


		   Session::flash('message', 'The records are updated successfully');	
		   return Redirect::to('bookings/show/'.$id);		
		}else{

			$data = Bookings::orderBy('id', 'desc')->first();

			if(isset($data->id)){
				$index = $data->id+1;
			}else{
				$index = 1;
			}

			$x = strlen($index);
			$y = null;
			for($i=4;$i>$x;$i--){
				$y.= '0';
			}
			$y.=$index;


			$booking_code = $year.''.$month.''.$date.''.$y;
			$employee_id = Input::get('employee_id');

			if($employee_id){
				$employee_id = Input::get('employee_id');
			}else{
				$employee_id = NULL;
			}

			$bookings = new Bookings;
			$bookings->booking_code = $booking_code;
			$bookings->guest_id = Input::get('guest_id');
			$bookings->employee_id = $employee_id;
			$bookings->number_of_days = Input::get('number_of_days');
			$bookings->date_booking = Input::get('date_booking');
			$bookings->date_booking_from = Input::get('date_booking');
			$bookings->date_booking_to = Input::get('date_booking_to');
			$bookings->save();
			$last = Bookings::orderBy('id', 'desc')->first();
			$last_id = $last->id;

			$service_id = Input::get('service_id');
			$TOTAL = 0;
			for($i=0;$i<count($service_id);$i++){
				$cek_bs = BookingServices::where('service_id','=',$service_id[$i])->first();
				if(empty($cek_bs)){
					$booking_service = new BookingServices;
					$d_service = Services::find($service_id[$i]);
					$booking_service->booking_id = $last_id;
					$booking_service->service_id = $service_id[$i];
					$booking_service->price = $d_service->price;
					$booking_service->save();
					$TOTAL+=$d_service->price;
				}
			}

			$room_id = Input::get('room_id');
			for($j=0;$j<count($room_id);$j++){
				$cek_r = BookingRooms::where('room_id','=',$room_id[$j])->first();
				if(empty($cek_r)){
					$booking_room = new BookingRooms;
					$d_room = Room::find($room_id[$j]);
					$d_room->booked = 1;
					$booking_room->booking_id = $last_id;
					$booking_room->room_id = $room_id[$j];
					$booking_room->price = $d_room->type->price;
					$booking_room->save();
					$d_room->save();
					$TOTAL+=$d_room->type->price;
				}
			}

			$TOTAL = $TOTAL*$bookings->number_of_days;


			$holiday = date('D');
			if($holiday=='Sat'||$holiday=='Sun'){
				$disc = 0.05;
			}else{
				$disc = 0;
			}

			$discount = $TOTAL*$disc;
			$grand_total = $TOTAL - $discount;

			$payment = new Payments;
			$payment->booking_id = $last_id;
			$payment->subtotal = $TOTAL;
			$payment->disc =$disc;
			$payment->grand_total = $grand_total;
			$payment->cashed = 0;
			$payment->save();

			Session::flash('message', 'The records are inserted successfully');
			return Redirect::to('bookings/show/'.$last_id);
		}
		
	}

	public function getShow($id){
		$data = Bookings::find($id);
		$rooms = BookingRooms::where('booking_id','=',$id)->get();
		$service = BookingServices::where('booking_id','=',$id)->get();
		$options = array(
			'data'=>$data,
			'rooms'=>$rooms,
			'service'=>$service,
		);
		return View::make('home/dashboard',array())->nest('content', 'bookings/show',$options);
	}

	public function getEdit($id){
		$data = Bookings::find($id);
		$rooms = BookingRooms::where('booking_id','=',$id)->get();
		$service = BookingServices::where('booking_id','=',$id)->get();
		$options = array(
			'data'=>$data,
			'rooms'=>$rooms,
			'service'=>$service,
		);
		return View::make('home/dashboard',array())->nest('content', 'bookings/edit',$options);
	}

	public function getGuest(){
		$q = Input::get('q');
		$data = Guest::where('full_name', 'like', '%'.$q.'%')->orderBy('full_name', 'asc')->limit(10)->get();
		$array = array();
		foreach($data as $row){
			$array[] = array(
				'id'=>$row->id,
				'text'=>$row->full_name
			);
		}
		echo json_encode($array);
	}

	public function getType(){
		$q = Input::get('q');
		$data = Type::where('name', 'like', '%'.$q.'%')->orderBy('name', 'asc')->limit(10)->get();
		$array = array();
		foreach($data as $row){
			$array[] = array(
				'id'=>$row->id,
				'text'=>$row->name
			);
		}
		echo json_encode($array);
	}

	public function getRooms($id){
		$data = Room::where('type_id',$id)->get();
		$html = '';
		$html .= '<option></option>';
		foreach($data as $d){
			$html .= '<option value="'.$d->id.'">'.$d->name.'</option>';
		}
		echo $html;
	}

	public function getPrice($id){
		$data = Room::find($id);
		$array[] = array(
			'number'=>$data->number,
			'price'=>$data->type->price
		);
		echo json_encode($array);
	}

	public function getService(){
		$q = Input::get('q');
		$data = Services::where('name', 'like', '%'.$q.'%')->orderBy('name', 'asc')->limit(10)->get();
		$array = array();
		foreach($data as $row){
			$array[] = array(
				'id'=>$row->id,
				'text'=>$row->name.' - $'.$row->price
			);
		}
		echo json_encode($array);
	}

	public function getDelete($id){

		$payment = Payments::where('booking_id',$id);
		$payment->delete();

		$bs = BookingServices::where('booking_id',$id);
		$bs->delete();

		$br = BookingRooms::where('booking_id',$id);
		$br->delete();

		$bookings = Bookings::find($id);
		$bookings->delete();

		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('bookings');
		
	}

	public function getReport(){
		$first_date = Input::get('first_date');
		$last_date = Input::get('last_date');
		$submit =  Input::get('submit');
		$page = Input::get('page');
		if(isset($first_date) && isset($last_date)){
			$data = Bookings::where('date_booking','>=',$first_date)->where('date_booking','<=',$last_date)->paginate(10);
		}else{
			$data = Bookings::orderBy('id', 'desc')->paginate(10);
		}
		if(isset($submit) && $submit=='print'){

			if(isset($page)){
				$no = ($page*10)-9;
			}else{
				$no = 1;
			}

			$pdf = App::make('dompdf');
			$html = '<center><b>Report of Bookings</b></center>';
			$html .= '<br><br><br>';
			$html .= '<table border="1" align="center" width="100%" padding="0" cellpadding="5">';
			$html .= '<tr>';
				$html .= '<td>No</td>';
				$html .= '<td>Booking Code</td>';
				$html .= '<td>Date Booking</td>';
				$html .= '<td>Date Expired</td>';
				$html .= '<td>Service Count</td>';
				$html .= '<td>Room Count</td>';
			$html .= '</tr>';
			foreach($data as $row){
				$html .= '<tr>';
					$html .= '<td>'.$no.'</td>';
					$html .= '<td>'.$row->booking_code.'</td>';
					$html .= '<td>'.$row->date_booking.'</td>';
					$html .= '<td>'.$row->date_booking_to.'</td>';
					$html .= '<td>'.CountService($row->id).'</td>';
					$html .= '<td>'.CountRoom($row->id).'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '</table>';

			$pdf->loadHTML($html)->setPaper('a4')->setOrientation('potrait');
			return $pdf->download('Report Of Booking.pdf');

		}else{
			return View::make('home/dashboard',array())->nest('content', 'bookings/report',array('data'=>$data));
		}
	}

	public function getPayments(){
		$first_date = Input::get('first_date');
		$last_date = Input::get('last_date');
		$submit =  Input::get('submit');
		$page = Input::get('page');
		if(isset($first_date) && isset($last_date)){
			$data = Bookings::where('date_booking','>=',$first_date)->where('date_booking','<=',$last_date)->paginate(10);
		}else{
			$data = Bookings::orderBy('id', 'desc')->paginate(10);
		}
		if(isset($submit) && $submit=='print'){

			if(isset($page)){
				$no = ($page*10)-9;
			}else{
				$no = 1;
			}

			$pdf = App::make('dompdf');
			$html = '<center><b>Report of Financial</b></center>';
			$html .= '<br><br><br>';
			$html .= '<table border="1" align="center" width="100%" padding="0" cellpadding="5">';
			$html .= '<tr>';
				$html .= '<td>No</td>';
				$html .= '<td>Booking Code</td>';
				$html .= '<td>Date Booking</td>';
				$html .= '<td>Date Expired</td>';
				$html .= '<td>Service & Room Count</td>';
				$html .= '<td>Total</td>';
			$html .= '</tr>';
			foreach($data as $row){
				$temp = CountService($row->id)+CountRoom($row->id);
				$html .= '<tr>';
					$html .= '<td>'.$no.'</td>';
					$html .= '<td>'.$row->booking_code.'</td>';
					$html .= '<td>'.$row->date_booking.'</td>';
					$html .= '<td>'.$row->date_booking_to.'</td>';
					$html .= '<td>'.$temp.'</td>';
					$html .= '<td>'.Total($row->id).'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '</table>';
			
			$pdf->loadHTML($html)->setPaper('a4')->setOrientation('potrait');
			return $pdf->download('Report Of Financial.pdf');

		}else{
			return View::make('home/dashboard',array())->nest('content', 'payments/report',array('data'=>$data));
		}
		
	}

}