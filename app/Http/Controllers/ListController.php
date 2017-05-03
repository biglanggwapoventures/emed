<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Requests\PatientRequest;
use App\User;
use App\Doctor;
use App\Secretary;
use App\PharmacyManager;
use Validator;
use Auth;


class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Patient::all();
        return view('list.patients', [
            'items' => $items
        ]);
    }

       public function doctorList()
    {
        $items = Doctor::all();
        return view('list.doctorList', [
            'items' => $items
        ]);
    }

       public function secretaryList()
    {
        $items = Secretary::all();
        return view('list.secretaryList', [
            'items' => $items
        ]);
    }

       public function pmanagerList()
    {
        $items = PharmacyManager::all();
        return view('list.managerList', [
            'items' => $items
        ]);
    }

      public function pharmaList()
    {
        $items = PharmacyManager::all();
        return view('list.pharmacistList', [
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
