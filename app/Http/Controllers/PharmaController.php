<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharma;
use App\PharmacyManager;
use App\Http\Requests\PharmaRequest;
use App\User;
use App\Common;
use Auth;

use Log;

class PharmaController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::user()->user_type === 'ADMIN')
        {
            $items = Common::retrieveAllPharmas();
            return view('pharmacists.list', [
                    'items' => $items
                ]);
        }
        elseif(Auth::user()->user_type === 'PMANAGER')
        {
            $search =  $request->input('search');
            $items = Pharma::where('drugstore', Auth::user()->manager->drugstore);

            if(trim($search)){
                $items->whereHas('userInfo', function($q) USE($search){
                    $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE '%{$search}%'");
                });
            }

            return view('pharmacists.list', [
                'items' => $items->get()
            ]);
        }
        else{
             $items = Pharma::all();
            return view('pharmacists.list', [
                    'items' => $items
                ]);
        }
            
    }

    public function showHomepage()
    {
        $items = Pharma::with('userInfo')->get();
        // dd($items);
        return view('pharmacists.pharma-home', [
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
         if(Auth::user()->user_type != 'PMANAGER'){

            Log::error('ACCESS DENIED. User tries to access a custom user\'s homepage that is not included in the current user\'s list of permissions.');
             abort(503);
         }
        

          else{

             $pman = Auth::user()->manager;
          return view('pharmacists.pharma-form', [
             'pman' => $pman
         ]);

          }

         //return view('pharmacists.pharma-form');

    }

     public function phlist()
    {
        $items = Pharma::with('userInfo')->get();
        // dd($items);
        return view('pharmacists.pharma-home', [
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmaRequest $request)
    {
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
        $input['user_type'] = 'PHARMA';
        $input['user_type_id'] = 6;
        $input['added_by'] = session('user_id');
        //save to DB (users)
        $user = User::create($input);

        // save to DB (pharmas)       
        $pharmacist = [
            'drugstore' => $request->drugstore,
            'drugstore_branch' => $request->drugstore_branch,
            'license' => $request->license,
            'user_id' => $user->id
        ];

        Auth::user()->manager->pharmacists()->create($pharmacist);

       // return redirect()->route('pharmacists.index');
        return redirect()
            ->intended(route('pharmacists.index'))
            ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'New pharmacists has been saved successfully!'
            ]);
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
        $pman = Auth::user()->manager;
          return view('pharmacists.edit', [
             'pman' => $pman,
             'data' => Pharma::with('userInfo')->where('user_id', $id)->first()
         ]);

        //  return view('pharmacists.edit', [
        //     'data' => Pharma::with('userInfo')->where('user_id', $id)->first()
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmaRequest $request, $id)
    {
        $pharma = Pharma::find($id);
        $pharma->fill([
            'license' => $request->license,
            'drugstore' => $request->drugstore,
            'drugstore_branch'=> $request->drugstore_branch,
            
        ]);
        $pharma->save();

        $user = User::find($pharma->user_id);
        $user->fill($request->only([
            'username', 
            'firstname', 
            'lastname',
            'middle_initial',
            'contact_number',
            'sex',
            'email',
            'birthdate',
            // 'address',

        ]));
        $user->save();
        return redirect()
            ->intended(route('pharmacists.index'))
            ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => ' pharmacists has been edited successfully!'
            ]);
        
       
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
