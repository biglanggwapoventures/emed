<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FileUploadController extends Controller
{
    public function uploadDisplayPhoto(Request $request)
    {
    	$this->validate($request, [
    		'avatar' => 'image|max:2048'
		]);

		$path = $request->file('avatar')->store(
		    'avatars/'.$request->user()->id, 'public'
		);

		$user = Auth::user();

		$user->avatar = $path;
		$user->save();

		return redirect()->back();
    }
}
