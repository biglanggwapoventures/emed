<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Requests\PatientRequest;
use App\User;
use App\Doctor;
use Auth;

class PatientsController extends Controller
{
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
    
    public function index()
    {
       // $patients = Auth::user()->doctor->patients()->get();
        $user = Auth::user();
        if($user->user_type === 'DOCTOR'){
            $patients = Auth::user()->doctor->patients()->paginate(6);
            return view('patients.list', [
                'patients' => $patients
            ]);
        }
        else if($user->user_type === 'SECRETARY'){
            $patients = Auth::user()->secretary->doctor->patients()->paginate(6);
            return view('patients.list', [
                'patients' => $patients
            ]);
        }
        else{
        $items = Auth::user()->patient;
            return view('patients.patient-home', [
                'items' => $items
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.patient-form');
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
                'lastname' => 'required',
                'username' => 'required|unique:users',
                'address' => 'required',
                'birthdate' => 'required|date',
                'avatar' => 'image|max:2048'
            ], [
                'firstname.required' => 'Please enter your first name.',
                'lastname.required' => 'Please enter your last name.',
                'username.required' => 'Please enter your username.',
                'address.required' => 'Please enter your address.',
           ]);

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
            'occupation'=> $request->occupation
        ]);

        // connect patient to doctor
        $patient->doctors()->attach(Auth::user()->secretary->doctor->id);

        // save patient's profile picture
        $path = $request->file('avatar')->store(
            'avatars/'.$user->id, 'public'
        );
        $user->avatar = $path;
        $user->save();

       return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Patient::find($id);
        return view('patients.patient-home', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view('patients.edit', [
            'data' => Patient::with('userInfo')->where('id', $id)->first()
        ]);
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
        $patient->fill($request->only([
            'bloodtype' => $request->bloodtype,
            'nationality' => $request->nationality,
            'civilstatus'=> $request->civilstatus,
            'erelationship' => $request->erelationship,
            'econtact'=> $request->econtact,
            'enumber'=> $request->enumber
        ]));
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

        ]));
        $user->save();
        

       return redirect()->route('patients.index');
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
