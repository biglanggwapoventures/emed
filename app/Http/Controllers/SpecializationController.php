<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialization;
use Validator;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('specialization.list', [
            'items' => Specialization::orderBy('name', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialization.manage', [
            'data' => new Specialization
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
        $v = Validator::make($request->all(), [
            'name' => 'required|unique:specializations',
            'subs' => 'present|array'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $spec = new Specialization;
        $spec->name = $request->input('name');
        $spec->subs = array_values(array_filter($request->input('subs'), 'trim'));
        $spec->save();

        if($spec->id){
            return response()->json([
                'result' => true
            ]);
        }

        return response()->json([
            'result' => false,
            'errors' => ['Cannot create new specialization due to an unknown error']
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
            'data' => Specialization::find($id) 
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
            'subs' => 'present|array'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $spec = Specialization::find($id);
        $spec->name = $request->input('name');
        $spec->subs = array_values(array_filter($request->input('subs'), 'trim'));
        $spec->save();

        if($spec->id){
            return response()->json([
                'result' => true
            ]);
        }

        return response()->json([
            'result' => false,
            'errors' => ['Cannot update specialization due to an unknown error']
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
