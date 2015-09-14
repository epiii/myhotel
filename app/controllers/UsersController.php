<?php

class UsersController extends Controller{

	public function getIndex(){
		$key = Input::get('search');
		if(isset($key)){
			$data = Users::where('username', 'like', '%'.$key.'%')->orderBy('id', 'desc')->paginate(10);
		}else{
			$data = Users::orderBy('id', 'desc')->paginate(10);
		}
		return View::make('home/dashboard',array())->nest('content', 'users/index',array('data'=>$data));
	}

	public function getAdd(){
		return View::make('home/dashboard',array())->nest('content', 'users/add',array());
	}

	public function getSave(){
		$id = Input::get('id');
		$employee_id = Input::get('employee_id');
		$username = Input::get('username');
		$pass1 = Input::get('password1');
		$pass2 = Input::get('password2');
		if($id){
			$exist_username = Users::where('username','=',$username)->where('id','!=',$id)->first();
			if(!empty($exist_username)){
				Session::flash('message', 'Sorry, Username was exists');
				return Redirect::to('users/edit/'.$id);
			}else{
				if($pass1!=$pass2){
					Session::flash('message', 'Sorry, Password not same');
					return Redirect::to('users/edit/'.$id);
				}else{
					if($employee_id){
						$user = Users::find($id);
						$user->username = $username;
						$user->employee_id = $employee_id;
						$user->password = md5($pass1);
						$user->save();
						Session::flash('message', 'The records are updated successfully');
						return Redirect::to('users');
					}else{
						$user = Users::find($id);
						$user->username = $username;
						$user->password = md5($pass1);
						$user->save();
						Session::flash('message', 'The records are updated successfully');
						return Redirect::to('users');
					}
				}	
			}	
		}else{
			$exist_username = Users::where('username','=',$username)->first();
			if(!empty($exist_username)){
				Session::flash('message', 'Sorry, Username was exists');
				return Redirect::to('users/add');
			}else{
				if($employee_id){
					$exists_employee = Users::where('employee_id','=',$employee_id)->first();
					if(!empty($exists_employee)){
						Session::flash('message', 'Sorry, Employee was exists');
						return Redirect::to('users/add');
					}else{
						if($pass1!=$pass2){
							Session::flash('message', 'Sorry, Password not same');
							return Redirect::to('users/add');
						}else{
							$user = new Users;
							$user->username = $username;
							$user->employee_id = $employee_id;
							$user->password = md5($pass1);
							$user->save();
							Session::flash('message', 'The records are inserted successfully');
							return Redirect::to('users');
						}	
					}
				}else{
					if($pass1!=$pass2){
						Session::flash('message', 'Sorry, Password not same');
						return Redirect::to('users/add');
					}else{
						$user = new Users;
						$user->username = $username;
						$user->password = md5($pass1);
						$user->save();
						Session::flash('message', 'The records are inserted successfully');
						return Redirect::to('users');
					}
				}
			}
			
		}
		
	}

	public function getShow($id){
		$data = Users::find($id);
		return View::make('home/dashboard',array())->nest('content', 'users/show',array('data'=>$data));
	}

	public function getEdit($id){
		$data = Users::find($id);
		return View::make('home/dashboard',array())->nest('content', 'users/edit',array('data'=>$data));
	}

	public function getDelete($id){
		$users = Users::find($id);
		$users->delete();
		Session::flash('message', 'The records are deleted successfully');
		return Redirect::to('users');
	}

	public function getEmployee(){
		$q = Input::get('q');
		$data = Employee::where('full_name', 'like', '%'.$q.'%')->orderBy('full_name', 'asc')->limit(10)->get();
		$array = array();
		foreach($data as $row){
			$array[] = array(
				'id'=>$row->id,
				'text'=>$row->full_name
			);
		}
		echo json_encode($array);
	}

}