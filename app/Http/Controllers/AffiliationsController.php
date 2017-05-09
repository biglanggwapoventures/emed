<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Affiliation AS Aff;
use App\AffiliationBranch AS Branch;
use Validator;

class AffiliationsController extends Controller
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
        return view('affiliations.list', [
            'items' => Aff::with('branches')->orderBy('name', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aff = new Aff;
        $aff->branches = [new Branch];
        return view('affiliations.manage', [
            'data' => $aff
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
            'name' => 'required|unique:affiliations',
            'branches' => 'required|array|different:name',
            'branches.*.name' => 'required|distinct|different:name',
        );

        $messages = array(
            'name.unique' => 'The affiliation already exists.',
            'branches.*.name.different' => 'The branch is the same with the affiliation.',
            'branches.*.name.distinct' => 'The branch already exists.'
        );

        $v = Validator::make($request->all(), $rules, $messages);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $aff = Aff::create([
            'name' => $request->input('name')
        ]);

        $branches = [];
        foreach($request->input('branches') AS $sub){
            $branches[] = new Branch([
                'name' => $sub['name']
            ]);
        }

        $aff->branches()->saveMany($branches);

        return response()->json([
            'result' => true
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
        return view('affiliations.manage', [
            'data' => Aff::with('branches')->whereId($id)->first() 
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
            'name' => "required|unique:affiliations,name,{$id}",
            'branches' => 'required|array',
            'branches.*.id' => 'exists:affiliation_branches,id',
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $aff = Aff::find($id);
        $aff->name = $request->input('name');
        $aff->save();

        $branches = [];
        $existing = [];
        foreach($request->input('branches') AS $branch){
            if(isset($branch['id'])){
                $existing[] = $branch['id'];
                Branch::whereId($branch['id'])->update(['name' => $branch['name']]);
            }else{
                $branches[] = new Branch(['name' => $branch['name']]);
            }
        }

        if(!empty($existing)){
            Branch::whereAffiliationId($id)->whereNotIn('id', $existing)->delete();
        }else{
            Branch::whereAffiliationId($id)->delete();
        }

        if(!empty($branches)){
            $aff->branches()->saveMany($branches);
        }

         return response()->json([
             'result' => true
         ]);

    }
    // 
     // if($this->route("doctor"))
     //    {
     //        $user_id = \App\Doctor::find($this->route("doctor"))->user_id;
     //        $rules['username'] = 'required|unique:users,username,'.$user_id;
     //        $rules['email'] = 'required|unique:users,username,'.$user_id;
     //        if(Auth::user()->isDoctor()){
     //            unset($rules['prc'], $rules['ptr'], $rules['s2']);
     //        }
     //    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Aff::destroy($id);
        return redirect()->back();
    }
}
