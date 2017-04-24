<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SecretaryRequest;
use Validator;
use App\Secretary;
use App\User;
use App\Doctor;
use Auth;

class SecretaryController extends Controller
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
        if(session('user_type') === 'SECRETARY')
        {
            $items = Secretary::with('userInfo')->get();
            // dd($items);
            return view('secretary.secretary-home', [
                'items' => $items
            ]);
        }
        else
        {
            Log::error('ACCESS DENIED. User tries to access Secreatary\'s Homepage but is not included in the current user\'s list of permissions.');
            abort(503);
        }

           
    }

    public function index(Request $request)
    {

        // $search =  $request->input('search');
        
        
        // if(trim($search)){
        //     $items->whereHas('userInfo', function($q) USE($search){
        //         $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
        //     });
        // }

        if(Auth::user()->user_type === "DOCTOR")
        {
            $items = Auth::user()->doctor->secretaries();
            return view('secretary.list', [
                'items' => $items->get()
            ]);
        }

        else if(Auth::user()->user_type === "SECRETARY")
        {
            $patients = Auth::user()->secretary->doctor->patients();
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
    public function create()
    {
        //
        return view('secretary.secretary-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecretaryRequest $request)
    {
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
        $input['user_type'] = 'SECRETARY';
        //save to DB (users)
        $user = User::create($input);

        // save to DB (secretaries)       
        $secretary = [
            'attainment' => $request->attainment,
            'user_id' => $user->id
        ];

        Auth::user()->doctor->secretaries()->create($secretary);

        return redirect()->route('secretary.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('secretary.edit', [
            'data' => Secretary::with('userInfo')->where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SecretaryRequest $request, $id)
    {
        // get fields for user table

        $secretary = Secretary::find($id);
        $secretary->fill($request->only([
            'attainment' => $request->attainment
        ]));
        $secretary->save();

        $user = User::find($secretary->user_id);
        $user->fill($request->only([
            'username', 
            'firstname', 
            'lastname',
            'middle_initial',
            'contact_number',
            'sex',
            'email',
            'birthdate',
            'address'

        ]));
        $user->save();
        

       return redirect()->route('secretary.index');
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
