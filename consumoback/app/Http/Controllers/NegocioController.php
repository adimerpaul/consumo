<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Contribuyente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NegocioController extends Controller
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

    public function listactividad(){
        return DB::SELECT("SELECT * from actividades ");
    }

    public function regnegocio(Request $request){
        return $request;
        if($request->contribuyente['id']==null || $request->contribuyente['id']=='')
            $contrib= new Contribuyente;
            $contrib->nombres=$request->contribuyente['nombre'];
            $contrib->paterno=$request->contribuyente['paterno'];
            $contrib->materno=$request->contribuyente['materno'];
            $contrib->esposo=$request->contribuyente['esposo'];
            $contrib->cedula=$request->contribuyente['cedula'];
            $contrib->expedido=$request->contribuyente['expedido'];
            $contrib->telefono=$request->contribuyente['telefono'];
            $contrib->telofi=$request->contribuyente['telofi'];
            $contrib->domicilio=$request->contribuyente['domicilio'];
            $contrib->calle=$request->contribuyente['calle'];
            $contrib->numero=$request->contribuyente['numero'];
            $contrib->casilla=$request->contribuyente['casilla'];
            $contrib->fax=$request->contribuyente['fax'];
            $contrib->extrangero=$request->contribuyente['estrangero'];
            $contrib->numeroextrangero=$request->contribuyente['numeroextrangero'];
            $contrib->numerodni=$request->contribuyente['numerodni'];
            $contrib->zona=$request->contribuyente['zona'];
            $contrib->nit=$request->contribuyente['nit'];
            $contrib->save();
        }

    }

    public function lsector($id){
        return DB::SELECT("SELECT * from sectors where id=$id")[0];
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
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function show(Negocio $negocio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function edit(Negocio $negocio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Negocio $negocio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Negocio $negocio)
    {
        //
    }
}
