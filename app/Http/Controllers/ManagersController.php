<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PharmacyManager;
use App\Pharmacy;
use App\PharmacyBranch;
use App\Http\Requests\ManagerRequest;
use App\User;
use Auth;

use Log;

class ManagersController extends Controller
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
    public function transaction()
    {   
        return view('pharmacists.pharma-transaction');
    }

    public function index()
    {

        $items = PharmacyManager::with('userInfo')->get();
        // dd($items);
        return view('managers.list', [
            'items' => $items
        ]);
    }

    

    public function showHomepage()
    {

        $items = Auth::user()->manager;

        return view('managers.pmanager-home', [
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

         // return view('managers.manager-form');

        //   return view('managers.manager-form', [
        //     'orgs' => \App\Organizations::orderBy('organizations')->get()->pluck('organizations', 'id'),
        //     'affiliations' => \App\Affiliation::orderBy('name')->get()->pluck('name', 'id'),
        //     'affiliationBranches' => \App\AffiliationBranch::select('name', 'id', 'affiliation_id')->get()->groupBy('affiliation_id')
        // ]);

         return view('managers.manager-form', [
            'pharmacies' => Pharmacy::orderBy('name')->get()->pluck('name', 'id'),
            'pharmacyAddress' => PharmacyBranch::orderBy('address')->get()->pluck('address', 'id'),
            'pharmacyBranches' => PharmacyBranch::select('name', 'id', 'pharmacy_id','address')->get()->groupBy('pharmacy_id')
        ]);
    }

     public function phlist()
    {
        $items = PharmacyManager::with('userInfo')->get();
        // dd($items);
        return view('pharmacists.list', [
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerRequest $request)
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
         $input['password'] = bcrypt(strtolower(str_replace(' ','',$input['firstname'])).strtolower(str_replace(' ','',$input['lastname'])));
        // assign user type
        $input['user_type'] = 'PMANAGER';
        $input['user_type_id'] = 5;
        $input['added_by'] = session('user_id'); 

        //save to DB (users)
        $user = User::create($input);

        // save to DB (managers)       
        $user->manager()->create([
            'drugstore' => $request->drugstore,
            'drugstore_branch' => $request->drugstore_branch,
            'license' => $request->license
        ]);

        // $pharmacies = [];

        // foreach($request()->input('pharmacies') AS $pharm){
        //     $pharmacies[$aff['pharmacy_id']] = [
        //         'pharmacy_branch_id' => $aff['branch_id'],
        //         'address' => $pharm['clinic_hours'],
        //     ];
        // }

        // $doctor->affiliations()->sync($affiliations);

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
        $data = PharmacyManager::with('userInfo')->where('user_id', $id)->first();

            if(Auth::user()->user_type === "PMANAGER")
        {

         return view('managers.edit', [
            'data' => PharmacyManager::with('userInfo')->where('user_id', $id)->first()
        ]);

         }

        else{
            return view('managers.edit', [
            'data' => PharmacyManager::with('userInfo')->where('id', $id)->first()
        ]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerRequest $request, $id)
    {
       
        $manager = PharmacyManager::find($id);
        $manager->fill([
            'license' => $request->license,
            'drugstore' => $request->drugstore_id,
            'drugstore_branch'=> $request->drugstorebranch_id,
        ]);
        $manager->save();

        $user = User::find($manager->user_id);
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
        
        if(Auth::user()->user_type === "PMANAGER")
        {
           return redirect('/pmanager-home')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Edit manager successful!'
            ]);
        // return redirect('/doctor-home')->with('success', 0);

        }
         else if(Auth::user()->user_type === "ADMIN")
        {
           return redirect()->route('managers.index')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Edit manager successful!'
            ]);

        // return redirect('/patient-home')->with('success', 0);

        }
        else{
            return redirect()->route('managers.index')->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'Edit manager successful!'
            ]);

        }
       // return redirect()->route('admin.index');
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
