<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Common;

use Log, Mail;

class EmailController extends Controller
{
    public static function sendResetLinkEmail($recipient, $data)
    {
        $ajaxResponse = ['success' => false, 'message' => ''];

        try
        {
            Mail::queue('emails.passwordreset', $data, function ($message) use ($data)
            {
                $message->from('emedsrvcs@gmail.com', 'EMed Services')
                        ->to($data['recipient'], $data['fullname'])
                        // ->to('acbadz@gmail.com', 'Ariel Badilles')
                        ->replyTo('do-not-reply@gmail.com', 'do-not-reply')
                        ->subject('You have requested to reset your password');
            });

            $msg = 'An email has now been sent to the mail server to be sent to ' . $recipient;
            Log::info($msg);

            $ajaxResponse['success'] = true;
        }
        catch(Exception $e) 
        {
            $msg = 'An exception has occurred while sending reset email to requesting user.  ' . $e.getMessage();
            Log::critical($msg);
        }
        
        $ajaxResponse['message'] = $msg;
        // return view('emails.passwordreset');
        return json_decode(json_encode($ajaxResponse));
    }

    public static function sendTempAccessEmail($recipient, $data)
    {
        // $ajaxResponse = ['success' => false, 'message' => ''];

        try
        {
            Mail::queue('emails.temporaryaccess', $data, function ($message) use ($data)
            {
                $message->from('emedsrvcs@gmail.com', 'EMed Services')
                        ->to($data['recipient'], $data['fullname'])
                        // ->to('acbadz@gmail.com', 'Ariel Badilles')
                        ->replyTo('do-not-reply@gmail.com', 'do-not-reply')
                        ->subject('Your password has been reset');
            });

            $msg = 'INFO: An email has now been sent to the mail server to be sent to ' . $recipient;
            Log::info($msg);
        }
        catch(Exception $e) 
        {
            $msg = 'ERROR: An exception has occurred while sending temporary password email to requesting user.  ' . $e.getMessage();
            Log::critical($msg);
        }

        // $ajaxResponse['message'] = $msg;
        // return json_decode(json_encode($ajaxResponse));

        return redirect('/');
    }

}
