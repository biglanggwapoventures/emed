<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Doctor;
// use App\Doctor;

class AdminController extends Controller
{


	public function index()
	{
		$items = DB::select('select * from users');
		return view('admin.adminhome', [
            'items' => $items
        ]);
	}

	public function edit($id)
	{
		return view('doctors.edit');
	}
}
