<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization AS Spec;
use App\Subspecialization AS Sub;
use Validator;

class SpecializationController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass', 'permissions']);
        // $this->middleware('permissions');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('specialization.list', [
            'items' => Spec::with('subspecializations')->orderBy('name', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spec = new Spec;
        $spec->subspecializations = [new Sub];
        return view('specialization.manage', [
            'data' => $spec
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:specializations',
            'subs' => 'required|array',
            'subs.*.name' => 'required|distinct|different:name',
        );

        $messages = array(
            'name.unique' => 'The specialization already exists.',
            'subs.*.name.distinct' => 'The subspecialization already exists.',
            'subs.*.name.different' => 'The subspecialization and specialization must not be the same.'
        );
        
        $v = Validator::make($request->all(), $rules, $messages);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $spec = Spec::create([
            'name' => $request->input('name')
        ]);

        $subs = [];
        foreach($request->input('subs') AS $sub){
            $subs[] = new Sub([
                'name' => $sub['name']
            ]);
        }

        $spec->subspecializations()->saveMany($subs);

        return response()->json([
            'result' => true,
             'message' => 'Specialization Successfully Added!'
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
        return view('specialization.manage', [
            'data' => Spec::with('subspecializations')->whereId($id)->first() 
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
            'name' => "required|unique:specializations,name,{$id}",
            'subs' => 'required|array',
            'subs.*.name' => 'required|distinct|different:name',
            'subs.*.id' => 'exists:subspecializations,id',
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $spec = Spec::find($id);
        $spec->name = $request->input('name');
        $spec->save();

        $subs = [];
        $existing = [];
        foreach($request->input('subs') AS $sub){
            if(isset($sub['id'])){
                $existing[] = $sub['id'];
                Sub::whereId($sub['id'])->update(['name' => $sub['name']]);
            }else{
                $subs[] = new Sub(['name' => $sub['name']]);
            }
        }

        if(!empty($existing)){
            Sub::whereSpecializationId($id)->whereNotIn('id', $existing)->delete();
        }else{
            Sub::whereSpecializationId($id)->delete();
        }

        if(!empty($subs)){
            $spec->subspecializations()->saveMany($subs);
        }

        return response()->json([
            'result' => true,
             'message' => 'Specialization Successfully Edited!'
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
        Spec::destroy($id);
        return redirect()->back();
    }
}
