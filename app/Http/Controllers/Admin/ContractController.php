<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laradev\Http\Controllers\Controller;
use Laradev\User;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessors = User::lessors();
        $lessees = User::lessees();
        return view('admin.contracts.create',[
            'lessors' => $lessors,
            'lessees' => $lessees
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

    public function getDataOwner(Request $request)
    {
        $lessor = User::where('id',$request->user)->first([
            'id',
            'civil_status',
            'spouse_name',
            'spouse_document'
        ]);

        //Define uma validação para aceita somente married e separated
        $civilStatusSpouseRequired = [
            'married',
            'separated'
        ];

        //Se existir no array de lessor define spouse senão é nulo.
        if(in_array($lessor->civil_status, $civilStatusSpouseRequired)){
            $spouse = [
                'spouse_name' => $lessor->spouse_name,
                'spouse_document' => $lessor->spouse_document
            ];
        } else {
            $spouse = null;
        }

        $json['spouse'] = $spouse;

        return response()->json($json);//return response pois estamos trabalhando com ajax
    }
}
