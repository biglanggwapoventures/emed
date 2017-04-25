<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

class FileUploadController extends Controller
{
    public function uploadDisplayPhoto(Request $request)
    {
      $rules = array(
        'avatar' => 'image|max:2048'
      );

      $messages = array(
        'avatar.max' => 'File size too large. Choose file below 2MB.'
      );

    	$validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

      if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store(
        'avatars/'.$request->id, 'public'
        );

        $user = Auth::user()->find($request->id);

        $user->avatar = $path;
        $user->save();

        return redirect()->back();
      }
      else{
         return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
      }




  //   	$this->validate($request, [
  //   		'avatar' => 'image|max:2048'
		// ]);




	
    }
}
