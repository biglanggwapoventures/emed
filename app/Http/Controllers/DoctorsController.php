<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Validator;
use App\Doctor;
use App\User;
use App\Patient;
use Auth;
use App\Common;
use Log, EMedHelper, EMedUtil;

class DoctorsController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass']);
        $this->middleware('permissions', ['except' => ['showHomepage', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showHomepage()
    {
        if(session('user_type') === 'DOCTOR')
        {
            $docs = Auth::user()->doctor;
            return view('doctors.doctor-home', [
                'docs' => $docs
            ]);
        }
        else
        {
            Log::error('ACCESS DENIED. User tries to access a user\'s homepage that is not included in the current user\'s list of permissions.');
            abort(503);
        }
    }

    public function index()
    {
        if(EMedHelper::hasTargetActionPermission('DOCTOR', 'LIST'))
        {
            $items = Doctor::with('userInfo')->get();
            return view('doctors.list', [
                'items' => $items
            ]);
        }
        else
        {
            return redirect('/');
        }
            
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.doctor-form', [
            'orgs' => \App\Organizations::orderBy('organizations')->get()->pluck('organizations', 'id'),
            'affiliations' => \App\Affiliation::orderBy('name')->get()->pluck('name', 'id'),
            'affiliationBranches' => \App\AffiliationBranch::select('name', 'id', 'affiliation_id')->get()->groupBy('affiliation_id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        // dd($request->all());

        $this->validate($request, [
                'firstname' => 'required',
                'middle_initial' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users',
                'address' => 'required',
                'birthdate' => 'required|date',
                'sex' => 'required',
                'contact_number' => 'required|min:6'
            ], [
                'firstname.required' => 'Please enter your first name.',
                'middle_initial.required' => 'Please enter your middle initial.',
                'lastname.required' => 'Please enter your last name.',
                'birthdate.required' => 'Please enter your birthdate.',
                'username.required' => 'Please enter your username.',
                'address.required' => 'Please enter your address.',
                'sex.required' => 'Please select your gender.',
                'contact_number.required' => 'Please enter your contact number.'
           ]);

        // get fields for user table
        $input = $request->only([
            'username', 
            'firstname', 
            'lastname',
            'middle_initial',
            'contact_number',
            'birthdate',
            'sex',
            'email',
            'address'
        ]);
        // verify if username exists
        $credentials = $request->only(['username']);


        // assign password: default is firstname+lastname lowercase
        $input['password'] = bcrypt(strtolower($input['firstname']).strtolower($input['lastname']));
        // assign user type
        $input['user_type'] = 'DOCTOR';
        $input['user_type_id'] = 2;
        $input['added_by'] = session('user_id');
        
        //save to DB (users)
        $user = User::create($input);

        // save to DB (doctors)       
        $doctor = $user->doctor()->create([
            'specialization_id' => $request->specialization,
            // 'clinic' => $request->clinic,
            // 'clinic_address'=> $request->clinic_address,
            // 'clinic_hours' => $request->clinic_hours,
            'ptr' => $request->ptr,
            'prc' => $request->prc,
            's2' => $request->s2,
            'title' => $request->title,
            // 'subspecialty' => $request->subspecialty,
            // 'affiliations' => $request->affiliations,
            'med_school' => $request->med_school,
            'med_school_year' => $request->med_school_year,
            'residency' => $request->residency,
            'residency_year' => $request->residency_year,
            'training' => $request->training,
            'training_year' => $request->training_year,
        ]);

        $doctor->subspecializations()->sync($request->input('subspecializations'));
        $doctor->organizations()->sync($request->input('organizations'));
        
        $affiliations = [];
        foreach(request()->input('affiliations') AS $aff){
            $affiliations[$aff['affiliation_id']] = [
                'affiliation_branch_id' => $aff['branch_id'],
                'clinic_start' => $aff['clinic_start'],
                'clinic_end' => $aff['clinic_end'],
            ];
        }
        $doctor->affiliations()->sync($affiliations);
        

       // $user ['subspecialty'] = json_encode($input['subspecialty']);
       // return response()->json([
       //      'url' => route('doctors.index') 
       // ]);

        return redirect()->route('doctors.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(EMedUtil::isUserPatient())
        {
            $data = Patient::doctorOfPatient($id);
            if(EMedUtil::isInvalid($data))
            {
                Log::error('ACCESS DENIED. User tries to access a profile page that is not included in the current user\'s list of permissions.');
                abort(503);
            }
        }
        
        $doctors = Doctor::find($id);
        return view('doctors.doc-home', [
            'doctors' => $doctors
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
        $data = Doctor::whereUserId($id)->with(['userInfo', 'subspecializations', 'organizations', 'affiliations'])->first();
        // Log::info('EDIT: ' . json_encode($data));
        $orgs = \App\Organizations::orderBy('organizations')->get()->pluck('organizations', 'id');
        $affiliations = \App\Affiliation::orderBy('name')->get()->pluck('name', 'id');
        $affiliationBranches = \App\AffiliationBranch::select('name', 'id', 'affiliation_id')->get()->groupBy('affiliation_id');

        return view('doctors.edit', [
            'data' => $data,
            'orgs' => $orgs,
            'affiliations' => $affiliations,
            'affiliationBranches' => $affiliationBranches
        ]);
      }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $id)
    {
        // get fields for user table
        // dd($request->all());

        $doctor = Doctor::find($id);
        $data = [
            'specialization_id' => $request->specialization,
            'title' => $request->title,
            'med_school' => $request->med_school,
            'med_school_year' => $request->med_school_year,
            'residency' => $request->residency,
            'residency_year' => $request->residency_year,
            'training' => $request->training,
            'training_year' => $request->training_year,
        ];
        
        if(Auth::user()->isAdmin()){
            $data += [
                'prc' => $request->prc,
                'ptr' => $request->ptr,
                's2' => $request->s2,
            ];
        }
        $doctor->fill($data);
        $doctor->save();

        $doctor->subspecializations()->sync($request->input('subspecializations'));
        $doctor->organizations()->sync($request->input('organizations'));
        
        $affiliations = [];
        foreach(request()->input('affiliations') AS $aff){
            $affiliations[$aff['affiliation_id']] = [
                'affiliation_branch_id' => $aff['branch_id'],
                'clinic_start' => $aff['clinic_start'],
                'clinic_end' => $aff['clinic_end'],
            ];
        }
        $doctor->affiliations()->sync($affiliations);

        $user = User::find($doctor->user_id);
        $user->fill($request->only([
            'firstname', 
            'middle_initial',
            'lastname',
            'birthdate',
            'sex',
            'contact_number',
            'address',
            'username', 
            'email',
        ]));
        $user->save();
        
         if(Auth::user()->user_type === "ADMIN"){
        //    return response()->json([
        //     'url' => route('doctors.index')
        // ]);

              return redirect('doctors')
                    ->with('ACTION_RESULT',[
                      'type' => 'success',
                      'message' => 'Updated Successfully'

                      ]);
            // return response()->json([
            //  'result' => true,
            //  'message' => 'Doctor Successfully Edited!'
         // ]);
        }
        else if (Auth::user()->isDoctor()) {
             return redirect('doctor-home')
                    ->with('ACTION_RESULT',[
                      'type' => 'success',
                      'message' => 'Updated Successfully'

                      ]);
        //   return response()->json([
        //     'url' => url('/doctor-home') 
        // ]);
        }
        else{
       //      return response()->json([
       //      'url' => route('doctors.index') 
       // ]);
            return response()->json([
             'result' => true,
             'message' => 'Affiliation Successfully Edited!'
         ]);
        }
        // return response()->json([
        //     'url' => Auth::user()->isAdmin() ? route('doctors.index') : url('/doctor-home') 
        // ]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::de($id)->delete();
        // return redirect()->route('doctors.index');
    }
}
