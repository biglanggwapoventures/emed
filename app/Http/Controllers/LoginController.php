<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;

use App\Permissions;
use Session, Log;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //  $this->middleware()
    //  if(Auth::check()){
    //      return redirect('/');
    //  }   
    // }


    public function showLoginPage()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:users',
            'password' => 'required',
        ], [
            'username.exists' => 'Your username is not registered!',
            // 'username.required' => 'Ayaw i empty!'
        ]);

        $credentials = $request->only(['username', 'password']);
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();

            $roleId = $user->user_type_id;
            Session::put('user_type', strtoupper($user->user_type));
            Session::put('user_type_id', $roleId);

            Log::info(Session::all());

            if($user->user_type === 'ADMIN')
            {
                return redirect('admin');
            }
            else if($user->user_type === 'DOCTOR')
            {
                return redirect('doctor-home'); //test

            }else if($user->user_type === 'PMANAGER'){

                return redirect('pmanager-home'); //test

            }else if($user->user_type === 'PATIENT'){

                return redirect('patient-home'); //test

            }else if($user->user_type === 'SECRETARY'){

                return redirect('secretary-home'); //test

            }else if($user->user_type === 'PHARMA'){

                return redirect('pharmacists-home');
        }
 }

        else{
              return view('welcome', [
                'wrongPassword' => 'Incorrect Password'
            ]);
        }
       
    }
}

