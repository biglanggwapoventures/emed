<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PharmacyManager;
use App\User;
use Auth;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PharmacyManager::with('userInfo')->get();
        // dd($items);
        return view('managers.list', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('managers.manager-form');
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
                'middle_initial' => 'required',
                'username' => 'required|unique:users',
                'drugstore' => 'required',
                'drugstore_address' => 'required',
                'license' => 'required',
                'email' => 'required',
                'contact_number' => 'required' 
                //'birthdate' => 'required'
            ], [
                'firstname.required' => 'Please enter your first name.',
                'middle_initial.required' => 'Please enter your middle initial.',
                'lastname.required' => 'Please enter your last name.',
                'username.required' => 'Please enter your username.',
                'drugstore.required' => 'Please enter your drusgtore.',
                'drugstore_address.required' => 'Please enter your drusgtore address.',
                'license.required' => 'Please enter your license.',
                'email.required' => 'Please enter your email.',
                'contact_number.required' => 'Please enter your contact number.'
                //'birthdate.required' => 'Please enter your birthdate.'

           ]);

        // get fields for user table
        $input = $request->only(['username', 'firstname', 'lastname', 'middle_initial','email','contact_number','sex']);
        // verify if username exists
        $credentials = $request->only(['username']);

        // assign password: default is firstname+lastname lowercase
        $input['password'] = bcrypt(strtolower($input['firstname']).strtolower($input['lastname']));
        // assign user type
        $input['user_type'] = 'PMANAGER';
        //save to DB (users)
        $user = User::create($input);

        // save to DB (managers)       
        $user->manager()->create([
            'drugstore' => $request->drugstore,
            'drugstore_address' => $request->drugstore_address,
            'license' => $request->license
        ]);

       return redirect()->route('managers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
