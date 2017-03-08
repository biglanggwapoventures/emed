<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

// use App\Doctor;

class AdminController extends Controller
{
// im a slut

	public function index(Request $request)
	{
 		$search =  $request->input('search');
 		$type = $request->input('user_type');

 		$items = User::select();
 		if(trim($search)){
 			$items->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
 		}
 		if(in_array($type, ['DOCTOR','PMANAGER','PATIENT','PHARMA','SECRETARY'])){
 			$items->whereUserType($type);
 		}

        return view('admin.adminhome', [
        	'items' => $items->paginate(7)
    	]);
	}

	// public function edit($id)
	// {
	// 	return view('admin.edit-doc', [
	// 		'data' => Doctor::with('userInfo')->where('id', $id)->first()
	// 	]);
	// }
}
