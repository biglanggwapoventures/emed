<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organizations;
use Validator;

class OrganizationsController extends Controller
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
    public function index()


    {

           $items = Organizations::all();
        return view('organizations.organizations', [
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

        //           $this->validate($request,[
        //     'organizations' => 'required|unique:organizations'

        //     ], [
        //         'organizations.required' => 'Please input organization.',
        //         'organizations.unique' => 'The organization already exists.'
        //     ]);


        $input = $request->only([
            'organizations'
        ]);

        $rules = array(
            'organizations' => 'required|unique:organizations',
        );

        $messages = array(
            'organizations.required' => 'Please fill out organization.',
            'organizations.unique' => 'The organization already exists.',
        );
       
       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->passes()) {

        Organizations::create($input);
       return redirect()
            ->intended(route('organizations.index'))
            ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Saved Successfully!'
            ]);
        }
        else
        {

        return redirect()
            ->intended(route('organizations.index'))
            ->withErrors($validator)
            ->with('ACTION_RESULT', [
                'type' => 'danger', 
                'message' => 'Error Occured! Check entered organization.'
            ]);


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


        return view('organizations.organizations-edit', [
            'data' => Organizations::find($id)
        ]);
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

        $v = Validator::make($request->all(), [
             'organizations' => 'required|unique:organizations',
        ]);

        if($v->fails()){
              return redirect()->back()
                        ->withErrors($v)
                        ->withInput()
                        ->with('ACTION_RESULT', [
                'type' => 'error', 
                'message' => 'Organization already exists!'
            ]);
        }

        else{
              $data = Organizations::find($id);
        $data->fill([
            'organizations' => $request->organizations,
            
        ]);

        $data->save();

         return redirect('/organizations')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Edit Organizations successful!'
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
       Organizations::destroy($id);
        return redirect()->back();
    }
}
