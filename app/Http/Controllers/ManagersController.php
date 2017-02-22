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
         return view('managers.managerForm');
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
                'drugstore' => 'required'
            ], [
                'firstname.required' => 'Please enter your first name.',
                'lastname.required' => 'Please enter your last name.',
                'username.required' => 'Please enter your username.',
                'drugstore.required' => 'Please enter your drusgtore.',
           ]);

        // get fields for user table
        $input = $request->only(['username', 'firstname', 'lastname']);
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
            'drugstore' => $request->drugstore
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
