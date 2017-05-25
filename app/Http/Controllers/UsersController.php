<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permissions;

use Log, Session;

class UsersController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass', 'permissions']);
        // $this->middleware('permissions', ['except' => ['store', 'update', 'destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        User::edit($id);
        return redirect()->back();
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
        $data = Permissions::hasDeleteUserPermission($id);
        if(trim($data) !== '')
        {
            $msg = 'ACCESS DENIED. User tries to delete data of UserType=' . strtoupper($data) . ' but is not included in the current user\'s list of permissions.';

            Session::flash('503_msg', $msg);
            Log::error($msg);

            abort(503);
        }

        User::destroy($id);
        return redirect()->back();
    }
}
