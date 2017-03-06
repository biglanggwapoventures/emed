<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\User;
use App\Doctor;
// use App\Doctor;

class AdminController extends Controller
{
	public function index()
	{
		$items = User::orderBy('user_type')->paginate(7);
    	return view('admin.adminhome',compact('items'));
	}
}
