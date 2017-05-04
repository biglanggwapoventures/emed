<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;

use App\Permissions;
use App\UserRoles;
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

    public function redirectDefaultPage()
    {
        if(Auth::check())
        {
            return redirect(session('homepage'));
        }
        else
        {
            return view('login');
        }
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
            if(is_null($roleId))
            {
                $roleName = $user->user_type;
                $roleData = UserRoles::getRoleByName($roleName);

                if(is_null($roleData))
                {
                    Log::error('This user is assigned to a non-existing role. Contact with administrator.');
                    Auth::logout();
                }
                else
                {
                    $roleId = $roleData->id;
                }
            }
            else
            {
                $roleData = UserRoles::getRole($roleId);
            }

            Session::put('user_id', $user->id);
            Session::put('user_type', strtoupper($user->user_type));
            Session::put('user_type_id', $roleId);
            Session::put('user_type_name', $roleData->name);
            Session::put('user_type_disp_name', $roleData->display_name);

            Log::info(Session::all());

            if($user->user_type === 'ADMIN')
            {
                $path = 'userroles';
                // return redirect('userroles');
            }
            else if($user->user_type === 'DOCTOR')
            {
                $path = 'doctor-home';
                // return redirect('doctor-home');
            }
            else if($user->user_type === 'PMANAGER')
            {
                $path = 'pmanager-home'; 
                // return redirect('pmanager-home'); 
            }
            else if($user->user_type === 'PATIENT')
            {
                $path = 'patient-home'; 
                // return redirect('patient-home'); 
            }
            else if($user->user_type === 'SECRETARY')
            {
                $path = 'secretary-home'; 
                // return redirect('secretary-home'); 
            }
            else if($user->user_type === 'PHARMA')
            {
                $path = 'pharmacists-home';
                // return redirect('pharmacists-home');
            }
            else 
            {
                $path = 'home/' . $roleId;
                // return redirect('home/' . $roleId);
            }

            Session::put('homepage', $path);
            return redirect($path);
        }
 

        else{
              return view('welcome', [
                'wrongPassword' => 'Incorrect Password'
            ]);
        }
       
    }
}

