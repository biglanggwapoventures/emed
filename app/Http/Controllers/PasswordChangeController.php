<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
use App\Common;

use EMedHelper;
use Hash;

class PasswordChangeController extends Controller
{


    public function showHomepage()
    {

        return view('partials.ChangePass');

           
    }

    public function postUpdatePassword(Request $request) 
    {

        $user = Auth::user();

        $password = $request->only([
            'current_password', 'new_password', 'new_password_confirmation'
        ]);

        $validator = Validator::make($password, [
            'current_password' => 'required|current_password_match',
            'new_password'     => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@!$#%]).*$/|confirmed',

            ]);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();

        if(EMedHelper::isCurrentPassword($password['new_password']))
        {
            return redirect()->back()->with('ACTION_RESULT', [
                'type' => 'danger', 
                'message' => 'Password cannot be the same than current!'
            ]);
        }

        $updated = $user->update([ 'password' => bcrypt($password['new_password']), 'requirechange' => 0 ]);


        if($updated)
                if(Auth::user()->user_type === "DOCTOR")
        {
           return redirect('/doctor-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);
        return redirect('/doctor-home')->with('success', 0);

        }
         else if(Auth::user()->user_type === "PATIENT")
        {
           return redirect('/patient-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);

        return redirect('/patient-home')->with('success', 0);

        }
        else if(Auth::user()->user_type === "SECRETARY")
        {
           return redirect('/secretary-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);

        return redirect('/secretary-home')->with('success', 0);

        }
         else if(Auth::user()->user_type === "PMANAGER")
        {
           return redirect('/pmanager-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);
        return redirect('/pmanager-home')->with('success', 0);

        }
            
        else if(Auth::user()->user_type === "PHARMA")
        {
           return redirect('/pharmacists-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);
            return redirect('/pharmacists-home')->with('success', 0);

        }
         else if(Auth::user()->user_type === "ADMIN")
        {
           return redirect('/')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);
            return redirect('/')->with('success', 0);

        }
        else{

            return redirect()->back()->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Password change successful!'
            ]);
            return redirect()->back()->with('success', 0);
        }
    }



    public function requestReset()
    {
        $data = ['success' => false, 'message' => ''];
        
        if(Input::has('email')) 
        {
            $email = json_decode(Input::get('email'));
            $userData = Common::emailExists($email->address);
            $continue = !is_null($userData);

            if($continue)
            {
                $randomRawKey = (rand(1, 10) % 2 == 0 ? "eM" : "Em") . str_random(6) . (rand(1, 10) % 2 == 0 ? "eD" : "Ed");
                $randomRawKey = Hash::make($randomRawKey);
                $randomRawKey = str_replace('/', 'E', $randomRawKey);

                $mailview_param = [
                    "recipient" => $email->address,
                    "fullname"  => $userData->firstname . " " . $userData->lastname,
                    "name"      => $userData->firstname, 
                    "userid"    => $userData->id, 
                    "hashkey"   => $randomRawKey
                ];

                Common::updateHashKeyForRequestReset($mailview_param['recipient'], $randomRawKey);
                $response = EmailController::sendResetLinkEmail($mailview_param['recipient'], $mailview_param);

                if($response->success)
                {
                    $data['success'] = true;
                    $data['message'] = $response->message;
                }
                else
                {
                    $data['message'] = $response->message;   
                }
                
            }
            else
            {
                $data['message'] = 'Email address does not belong to any user in the system.';
            }
        }
        else
        {
            $data['message'] = 'No email address has been provided';
        }

        return json_encode($data);
    }

    public function resetPassword($id, $hashkey)
    {
        $continue = Common::isKeyForResetValid($id, $hashkey);

        if($continue) 
        {
            $userInfo = Common::getUserData($id);
            
            $fname = $userInfo->firstname;
            $lname = $userInfo->lastname;
            $email = $userInfo->email;

            $tempRawPass = (rand(1, 10) % 2 == 0 ? "eM" : "Em") . str_random(6) . (rand(1, 10) % 2 == 0 ? "eD" : "Ed");
            
            $name = $fname . " " . $lname;
            $mailview_param = [
                    "recipient"     => $email,
                    "fullname"      => $fname . " " . $lname,
                    "name"          => $fname, 
                    "temporaryPW"   => $tempRawPass
            ];
            // $param = ["id"=>$id, "pw"=>$tempRawPass];

            Common::updateUserPassCreds($id, $tempRawPass);
            EmailController::sendTempAccessEmail($email, $mailview_param);

            // return view('infopages.passwordreset', ["name"=>$name, "email"=>$email]);
            return redirect('login');
        }
        else
        {
            abort(404);
        }
    }
}
