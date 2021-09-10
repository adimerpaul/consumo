<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TramiteController extends Controller
{
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
        $tramites=DB::select("SELECT nrotramite FROM tramites WHERE id=(select max(id) FROM tramites) ");
        return $tramites[0];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;

        DB::table('tramites')->insert([
            'nrotramite'=>$request->nrotramite,
            'caso_id'=>$request->caso,
            'tramitador'=>$request->tramitador,
            'fecha'=>date('Y-m-d'),
            'hora'=>date('H:i:s'),
            'fechalimite'=>date('Y-m-d', strtotime(' + 21 days')),
            'user_id'=>$request->user()->id,
            'estado'=>"DIRECCION TRIBUTARIA",
            "estado2"=>"EN PROCESO",
            "tipo"=>"A",
            "nro"=>"",
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
