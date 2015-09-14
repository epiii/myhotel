<?php

class PaymentsController extends Controller{

	public function getIndex(){
		$first_date = Input::get('first_date');
		$last_date = Input::get('last_date');
		if(isset($first_date) && isset($last_date)){
			$data = Bookings::where('date_booking','>=',$first_date)->where('date_booking','<=',$last_date)->paginate(10);
		}else{
			$data = Bookings::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'payments/index',array('data'=>$data));
	}

	public function getPayed($id){
		$p = Payments::where('booking_id','=',$id)->first();
		$p->cashed = 1;
		$p->save();
		Session::flash('message', 'The payment and checout are updated successfully');	
		return Redirect::to('payments/show/'.$id);		
	}

	public function getShow($id){
		$data = Bookings::find($id);
		$rooms = BookingRooms::where('booking_id','=',$id)->get();
		$service = BookingServices::where('booking_id','=',$id)->get();
		$payments =  Payments::where('booking_id','=',$id)->first();
		$options = array(
			'data'=>$data,
			'payment'=>$payments,
			'rooms'=>$rooms,
			'service'=>$service,
		);
		return View::make('home/dashboard',array())->nest('content', 'payments/show',$options);
	}

	public function getPrint($id){
		$pdf = App::make('dompdf');
		$data = Bookings::find($id);
		$rooms = BookingRooms::where('booking_id','=',$id)->get();
		$service = BookingServices::where('booking_id','=',$id)->get();
		$payment =  Payments::where('booking_id','=',$id)->first();

		if(isset($data->employee->full_name)){
			$employee = $data->employee->full_name;
		}else{
			$employee = 'Administrator';
		}

		$x = str_replace('-', '0', $data->date_booking);
		$y = str_replace('-', '0', $data->date_booking_to);
		$z = $y-$x;

		$html = '<center><b>Detail Of Payments</b></center>';
		$html .= '<table border="0" align="center" width="100%" padding="0" cellpadding="5">';
			$html .= '<tr>';
				$html .= '<td>Receptionist</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$employee.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Booking Code</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$data->booking_code.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Date of Bookings</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$data->date_booking.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Number Of Days</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$z.' Days</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Date of Checkout</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$data->date_booking_to.'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Guest Name</td>';
				$html .= '<td>:</td>';
				$html .= '<td>'.$data->guest->full_name.'</td>';
			$html .= '</tr>';
		$html .= '</table>';

		$html .= '<br>';

		$html .= '<center><b>Detail Of Service</b></center>';
		$html .= '<table border="1" align="center" width="100%" padding="0" cellpadding="5">';
			$html .= '<tr>';
				$html .= '<td>No</td>';
				$html .= '<td>Service Name</td>';
				$html .= '<td>Price</td>';
			$html .= '</tr>';
			$no = 1;
			$ts = 0;
			foreach($service as $s){
				$html .= '<tr>';
					$html .= '<td>'.$no.'</td>';
					$html .= '<td>'.$s->service->name.'</td>';
					$html .= '<td>'.$s->service->price.'</td>';
				$html .= '</tr>';
				$no++;
				$ts+=$s->service->price;
			}
			$html .= '<tr>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
				$html .= '<td>'.$ts.'</td>';
			$html .= '</tr>';
		$html .= '</table>';

		$html .= '<br>';

		$html .= '<center><b>Detail Of Rooms</b></center>';
		$html .= '<table border="1"  align="center" width="100%" padding="0" cellpadding="5">';
			$html .= '<tr>';
				$html .= '<td>No</td>';
				$html .= '<td>Room Name</td>';
				$html .= '<td>Price</td>';
			$html .= '</tr>';
			$no = 1;
			$tr = 0;
			foreach($rooms as $r){
				$html .= '<tr>';
					$html .= '<td>'.$no.'</td>';
					$html .= '<td>'.$r->room->name.'</td>';
					$html .= '<td>'.$r->room->type->price.'</td>';
				$html .= '</tr>';
				$no++;
				$tr+=$r->room->type->price;
			}
			$html .= '<tr>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>-</td>';
				$html .= '<td>-</td>';
				$html .= '<td>'.$tr.'</td>';
			$html .= '</tr>';
		$html .= '</table>';

		$html .= '<br>';

		$html .= '<table border="0" align="center" width="100%" padding="0" cellpadding="5">';
		$html .= '<tr>';
			$html .= '<td>Subtotal</td>';
			$html .= '<td>:</td>';
			$html .= '<td>'.(($tr+$ts)*$z).'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td>Disc</td>';
			$html .= '<td>:</td>';
			$html .= '<td>'.($payment->disc*100).' %</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td>Discount</td>';
			$html .= '<td>:</td>';
			$html .= '<td>'.$payment->subtotal*$payment->disc.'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td>GrandTotal</td>';
			$html .= '<td>:</td>';
			$html .= '<td>'.$payment->grand_total.'</td>';
		$html .= '</tr>';
		$html .= '</table>';

		// echo $html;
		$pdf->loadHTML($html)->setPaper('a4')->setOrientation('potrait');
		return $pdf->download($data->booking_code.'.pdf');
	}

}