<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharmacy;
use Validator;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pharmacy.list', [
            'items' => Pharmacy::orderBy('name', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacy.manage', [
            'data' => new Pharmacy
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
            'name' => 'required|unique:pharmacies',
            'branches' => 'present|array'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $pharmacy = new Pharmacy;
        $pharmacy->name = $request->input('name');
        $pharmacy->branches = array_values(array_filter($request->input('branches'), 'trim'));
        $pharmacy->save();

        if($pharmacy->id){
            return response()->json([
                'result' => true
            ]);
        }

        return response()->json([
            'result' => false,
            'errors' => ['Cannot create new pharmacy due to an unknown error']
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
        return view('pharmacy.manage', [
            'data' => Pharmacy::find($id) 
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
            'name' => "required|unique:pharmacies,name,{$id}",
            'branches' => 'present|array'
        ]);

        if($v->fails()){
            return response()->json([
                'result' => false,
                'errors' => $v->errors()->all()
            ]);
        }

        $pharmacy = Pharmacy::find($id);
        $pharmacy->name = $request->input('name');
        $pharmacy->branches = array_values(array_filter($request->input('branches'), 'trim'));
        $pharmacy->save();

        if($pharmacy->id){
            return response()->json([
                'result' => true
            ]);
        }

        return response()->json([
            'result' => false,
            'errors' => ['Cannot update pharmacy due to an unknown error']
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
