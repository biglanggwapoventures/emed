<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Requests\PatientRequest;
use App\User;
use App\Doctor;
use App\Secretary;
use App\Permissions;
use App\UserRoles;
use App\CustomUser;
use Auth;

use Log;

class CustomUserController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions', ['except' => ['store', 'update', 'showHomepage']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHomepage()
    {

        if(session('user_type') === 'PATIENT')
        {
            $items = Auth::user()->patient;
            return view('patients.patient-home', [
                'items' => $items
            ]);
        }
        else
        {
            Log::error('ACCESS DENIED. User tries to access Patient\'s Homepage but is not included in the current user\'s list of permissions.');
            abort(503);
        }
    
    }
    
    public function index(Request $request, $id)
    {

        $user = Auth::user();
        $search =  $request->input('search');
       

        if($user->user_type === "DOCTOR"){
            $patients = Auth::user()->doctor->patients();

        if(trim($search)){
            $patients->whereHas('userInfo', function($q) USE($search){
                $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
            });
        }

            return view('patients.list', [
                'patients' => $patients->get()
            ]);
        }

        else if($user->user_type === "SECRETARY"){
            $patients = Auth::user()->secretary->doctor->patients();

        if(trim($search)){
            $patients->whereHas('userInfo', function($q) USE($search){
                $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
            });
        }

            return view('patients.list', [
                'patients' => $patients->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = Auth::user()->where('username', 'mdag')->get();
        return view('custom-user.user-form', [
                'item' => $item, 'id' => $id
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Log::info($request);
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
                'email' => 'required|email|unique:users'
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
                'email.required' => 'Please enter your email.'
           ]);

        // get fields for user table
        $input = $request->only([
            'username', 
            'firstname', 
            'lastname',
            'address',
            'middle_initial',
            'birthdate',
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
        // $permission = Permissions::hasPermission($id);
        // $userType = substr($permission->display_name, 16, strlen($permission->display_name) - 16);

        $roleData = UserRoles::getRole($id);
        $userType = $roleData->name;
        $input['user_type_id'] = $id;
        $input['user_type'] = $userType;
        
        Log::info($input);


        //save to DB (users)
        $user = User::create($input);

        $custom_user_data = [
            'user_id'           => $user->id,
            'bloodtype'         => $request->bloodtype,
            'econtact'          => $request ->econtact,
            'enumber'           => $request->enumber,
            'nationality'       => $request->nationality,
            'civilstatus'       => $request->civilstatus,
            'erelationship'     => $request->erelationship,
            'occupation'        => $request->occupation,
            'created_at'         => date("Y-m-d H:i:s"),
            'updated_at'         => date("Y-m-d H:i:s")
        ];

        CustomUser::storeData($custom_user_data);
        

        // save patient's profile picture
        $path = $request->file('avatar')->store(
            'avatars/'.$user->id, 'public'
        );
        $user->avatar = $path;
        $user->save();

        return redirect('admin');
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
            return view('patients.doc-patienthome', [
                'patients' => $patients
            ]);
        }
        else if(Auth::user()->user_type === 'PATIENT' || Auth::user()->user_type === 'SECRETARY')
        {
            $items = Patient::find($id);
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
        $data = CustomUser::retrieveData($id);
        Log::info(json_encode($data));
        if(is_null($data))
        {
            Log::info('Custom user data with id=' . $id . ' does not exist in the system');
            abort(503);
        }
        else
        {
            return view('custom-user.edit', ['data' => $data]);
        }

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
        
        Log::info($request);

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

        ]));
        $user->save();
        

       if(Auth::user()->user_type === "DOCTOR")
        {
            return redirect()->route('patients.index');
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
