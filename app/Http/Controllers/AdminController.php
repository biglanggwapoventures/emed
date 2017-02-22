<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function showHomepage()
	{
		// potang ina mo
		return view('admin.adminhome');
	}

	
}
