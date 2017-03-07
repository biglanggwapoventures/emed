<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

// use App\Doctor;

class AdminController extends Controller
{


	public function index(Request $request)
	{
		// $items = DB::select('select * from users');
		// return view('admin.adminhome', [
  //           'items' => $items
  //       ]);
		
		//$items = DB::table('users')->paginate(7);
    	//return view('admin.adminhome',compact('items'));

 
 		$search =  $request->input('search');
 		$type = $request->input('user_type');

 		$items = User::select();
 		if(trim($search)){
 			$items->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
 		}
 		if(in_array($type, ['DOCTOR','PMANAGER','PATIENT','PHARMA','SECRETARY'])){
 			$items->whereUserType($type);
 		}

        // $items = User::where('lastname','like','%'.$search.'%')->orWhere('firstname', 'like', '%'.$search.'%');
        // $final = User::where('user_type','like','%'.$categ.'%')->orderBy('id')->paginate(7);
        return view('admin.adminhome', [
        	'items' => $items->paginate(7)
    	]);
	}
}
