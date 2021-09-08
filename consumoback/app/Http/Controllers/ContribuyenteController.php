<?php

namespace App\Http\Controllers;

use App\Models\Contribuyente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContribuyenteController extends Controller    
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::connection('indcom')->table('natur')->get();
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
     * @param  \App\Models\Contribuyente  $contribuyente
     * @return \Illuminate\Http\Response
     */
    public function show(Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribuyente  $contribuyente
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribuyente  $contribuyente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribuyente  $contribuyente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribuyente $contribuyente)
    {
        //
    }

    public function listactividad(){
        return DB::connection('vutrat')->table('actividad')->get();
    }

    public function requisito(Request $request){
        $actividad=DB::connection('vutrat')->table('actividad')->where('codigo',$request->codigo)->get();
        if($actividad->req_s2 && $actividad->req_s3 && $request->tipo=='N')
            return DB::connection('vutrat')->table('v_requis')->where('cod_prin',2)->orWhere('cod_prin',3)->get();
        if($actividad->req_s1 && $request->tipo=='J')
            return DB::connection('vutrat')->table('v_requis')->where('cod_prin',1)->get();
        if($actividad->req_s2 && $request->tipo=='N')
            return DB::connection('vutrat')->table('v_requis')->where('cod_prin',2)->get();
        if($actividad->req_s3 && $request->tipo=='N')
            return DB::connection('vutrat')->table('v_requis')->where('cod_prin',3)->get();
    }
}
