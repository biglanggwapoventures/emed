<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Requests\PatientRequest;
use App\User;
use App\Doctor;
use App\Secretary;
use Validator;
use Auth;

use App\Common;
use Log, EMedHelper;

class PatientsController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass']);
        $this->middleware('permissions', ['except' => ['showHomepage']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHomepage()
    {
        $items = Auth::user()->patient;
        return view('patients.patient-home', [
            'items' => $items
        ]);
    
    }
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $search =  $request->input('search');
       

        if($user->user_type === "DOCTOR")
        {
            $patients = Auth::user()->doctor->patients();

            if(trim($search))
            {
                $patients->whereHas('userInfo', function($q) USE($search)
                {
                    $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
                });
            }

            $doctorId = Common::getDoctorId($user->id);
            Log::info('DOCTOR_ID: ' . $doctorId);
            $patients = Common::retrieveAttachedPatientsAndFloating($doctorId);

            return view('patients.list', [
                // 'patients' => $patients->get()
                'patients' => $patients
            ]);
        }

        else if($user->user_type === "SECRETARY")
        {
            $patients = Auth::user()->secretary->doctor->patients();

            if(trim($search))
            {
                $patients->whereHas('userInfo', function($q) USE($search)
                {
                    $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
                });
            }

            return view('patients.list', [
                'patients' => $patients->get()
            ]);
        }
        else
        {
            if(EMedHelper::hasTargetActionPermission('PATIENT', 'LIST'))
            {
                $items = PATIENT::with('userInfo')->get();
                return view('patients.list', [
                    'patients' => $items
                ]);
            }
            else
            {
                // this is where only the data saved by this particular user will be shown
                $items = Common::retrieveUsersOfCurrentUser('PATIENT');
                return view('patients.list', [
                    'patients' => $items
                ]);
            }
        } 

        //     if($user->user_type === 'ADMIN')
        // {
        //     $items = Common::retrieveAllUsers('PATIENT');
        //     return view('patients.list', [
        //             'patients' => $items
        //         ]);
        // }
        // else
        // {
        //     $items = Common::retrieveUsersOfCurrentUser('PATIENT');
        //     return view('patients.list', [
        //             'patients' => $items
        //         ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Auth::user()->where('username', 'mdag')->get();
        return view('patients.patient-form', [
                'item' => $item
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate input
        $this->validate($request, [
                'firstname' => 'required',
                'middle_initial' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users',
                'address' => 'required',
                'birthdate' => 'required|date_format:"Y-m-d"',
                'sex' => 'required',
                'contact_number' => 'required|min:6',
                'civilstatus' => 'required',
                'bloodtype' => 'required',
                'nationality' => 'required',
                'occupation' => 'required',
                'email' => 'required|email|unique:users',
                'enumber' => 'required',
                'erelationship' => 'required',
                'econtact' => 'required',
            ], [
                'firstname.required' => 'Please enter your first name.',
                'middle_initial.required' => 'Please enter your middle initial.',
                'lastname.required' => 'Please enter your last name.',
                'birthdate.required' => 'Please enter your birthdate.',
                'username.required' => 'Please enter your username.',
                'address.required' => 'Please enter your address.',
                'sex.required' => 'Please select your gender.',
                'contact_number.required' => 'Please enter your contact number.',
                'civilstatus.required' => 'Please enter your civilstatus.',
                'bloodtype.required' => 'Please enter your bloodtype.',
                'nationality.required' => 'Please enter your nationality.',
                'occupation.required' => 'Please enter your occupation.',
                'email.required' => 'Please enter your email.',
                'econtact.required' => 'Please enter your emergency contact.',
                'erelationship.required' => 'Please enter your relationship with emergency contact.',
                'enumber.required' => 'Please enter your emergency person contact number.',
           ]);

        // save patient's profile picture
        $rules = array(
            'avatar' => 'required|image|max:2048'
        );

        $messages = array(
            'avatar.required' => 'Please choose profile picture.'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if(!$request->hasFile('avatar')) {
            return redirect()->back()
                        ->withErrors($validator);
        }
        else{
            // get fields for user table
            $input = $request->only([
                'username', 
                'firstname', 
                'lastname',
                'address',
                'middle_initial',
                'birthdate',
                'gender',
                'contact_number',
                'address',
                'email',
                'sex'
            ]);

            // verify if username exists
            $credentials = $request->only(['username']);

            // assign password: default is firstname+lastname lowercase
            $input['password'] = bcrypt(strtolower($input['firstname']).strtolower($input['lastname']));
            // assign user type
            $input['user_type'] = 'PATIENT';
            $input['user_type_id'] = 3;
            $input['added_by'] = session('user_id');
            //save to DB (users)
            $user = User::create($input);

            // save to DB      
            $patient = $user->patient()->create([
                'bloodtype' => $request->bloodtype,
                'econtact'=> $request ->econtact,
                'erelationship'=> $request->erelationship,
                'civilstatus'=> $request->civilstatus,
                'bloodtype'=> $request->bloodtype,
                'enumber'=> $request->enumber,
                'nationality'=> $request->nationality,
                'occupation'=> $request->occupation,
                'allergyquestion'=> $request ->allergyquestion,
                'allergyname'=> $request->allergyname,
                'civilstatus'=> $request->civilstatus,
                'bloodtype'=> $request->bloodtype,
                'enumber'=> $request->enumber,
                'nationality'=> $request->nationality,
                'occupation'=> $request->occupation
            ]);

            // connect patient to doctor
            if(Auth::user()->user_type === 'DOCTOR')
                $patient->doctors()->attach(Auth::user()->doctor->id);
            elseif(Auth::user()->user_type === 'SECRETARY')
                $patient->doctors()->attach(Auth::user()->secretary->doctor->id);            

            // save profile picture
            $path = $request->file('avatar')->store(
                'avatars/'.$user->id, 'public'
            );
            $user->avatar = $path;
            $user->save();

            // redirect
            // if(Auth::user()->user_type === "DOCTOR")
            // {
            //     return redirect()->route('patients.index');
            // }

            // else if(Auth::user()->user_type === "SECRETARY")
            // {
            //     return redirect()->route('patients.index');
            // }
            return redirect('patients');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->user_type === 'DOCTOR')
        {
            $patients = Patient::find($id);
            $validPrescriptions = Common::retrieveValidPrescriptions($patients->id);
            Log::info(json_encode($validPrescriptions));
            return view('patients.doc-patienthome', [
                'patients' => $patients
            ]);
        }
        else if(Auth::user()->user_type === 'PATIENT' || Auth::user()->user_type === 'SECRETARY')
        {
            $items = Patient::find($id);
            $validPrescriptions = Common::retrieveValidPrescriptions($items->id);
            Log::info(json_encode($validPrescriptions));
            return view('patients.patient-home', [
                'items' => $items
            ]);
        }
        else 
        {
            $items = Patient::find($id);
            $validPrescriptions = Common::retrieveValidPrescriptions($items->id);
            Log::info(json_encode($validPrescriptions));
            return view('patients.patient-home', [
                'items' => $items
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


       if(Auth::user()->user_type === "DOCTOR")
        {
             return view('patients.edit', [
            'data' => Patient::with('userInfo')->where('id', $id)->first()
        ]);

       } 

        else if(Auth::user()->user_type === "SECRETARY")
        {
              return view('patients.edit', [
            'data' => Patient::with('userInfo')->where('id', $id)->first()
        ]);
        }
        
        else if(Auth::user()->user_type === "PATIENT")
        {
             return view('patients.edit', [
            'data' => Patient::with('userInfo')->where('id', $id)->first()
        ]);


        }

        else{

             return view('patients.edit', [
            'data' => Patient::with('userInfo')->where('id', $id)->first()
        ]);
        }




         // $url = URL::route('home') . '#footer';
         // return Redirect::to($url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
       $patient = Patient::find($id);
        $patient->fill([
            'bloodtype' => $request->bloodtype,
            'nationality' => $request->nationality,
            'civilstatus'=> $request->civilstatus,
            'erelationship' => $request->erelationship,
            'econtact'=> $request->econtact,
            'enumber'=> $request->enumber,
            'allergyname' => $request->allergyname,
            'allergyquestion' => $request->allergyquestion,
            'past_disease'=> $request->past_disease,
            'past_surgery' => $request->past_surgery,
            'immunization'=> $request->immunization,
            'family_history'=> $request->family_history
        ]);
        $patient->save();

        $user = User::find($patient->user_id);
        $user->fill($request->only([
            'username', 
            'firstname', 
            'lastname',
            'middle_initial',
            'contact_number',
            'sex',
            'email',
            'birthdate',
            'address',
            'avatar'
        ]));
        $user->save();

        if($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store(
                'avatars/'.$user->id, 'public'
            );
            $user->avatar = $path;
            $user->save();
        }
        

       if(Auth::user()->user_type === "DOCTOR")
        {
            return redirect()->back();
        }

        else if(Auth::user()->user_type === "SECRETARY")
        {
            return redirect()->route('secretary.index');
        }

        else if(Auth::user()->user_type === "PATIENT")
        {
            $items = Patient::find($id);
            return view('patients.patient-home', [
                'items' => $items
            ]);
        }
        else{
            return redirect()->route('patients.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
