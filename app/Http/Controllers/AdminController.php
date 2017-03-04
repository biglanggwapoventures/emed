<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

// use App\Doctor;

class AdminController extends Controller
{


	public function index()
	{
		// $items = DB::select('select * from users');
		// return view('admin.adminhome', [
  //           'items' => $items
  //       ]);
		
		//$items = DB::table('users')->paginate(7);
    	//return view('admin.adminhome',compact('items'));

 
 		$search = \Request::get('search');
        $items = User::where('lastname','like','%'.$search.'%')->orderBy('id')->paginate(7);
        return view('admin.adminhome',compact('items'));
	}

	// public function edit($id)
	// {
	// 	return view('admin.edit-doc', [
	// 		'data' => Doctor::with('userInfo')->where('id', $id)->first()
	// 	]);
	// }
}
