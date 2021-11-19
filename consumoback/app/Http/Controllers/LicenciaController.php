<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\Seguimiento;
use App\Models\Tramite;
use App\Models\Contribuyente;
use App\Models\Caso;
use App\Models\Historialmulta;
use Illuminate\Http\Request;

class LicenciaController extends Controller
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

    public function listlicencia(){
        return Licencia::with('contribuyente')->with('negocio')->with('caso')->with('historialmultas')
        ->get();
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
        $tramite=Tramite::find($request->id);
        $tramite->estado="FINALIZADO";
        $tramite->save();
        $seguimiento= new Seguimiento();
        $seguimiento->nombre="TRAMITE FINALIZADO";
        $seguimiento->observacion="TERMINADO";
        $seguimiento->fecha=date('Y-m-d');
        $seguimiento->hora=date('H:i:s');
        $seguimiento->tramite_id=$tramite->id;
        $seguimiento->user_id=$request->user()->id;
        $seguimiento->save();
        $licencia=new Licencia();
        $licencia->num=$request->num;
        $licencia->numlicencia=$request->numlicencia;
        $licencia->fecha=$tramite->fecha;
        $licencia->fechaautorizacion=date('Y-m-d');
        $licencia->fechafin=date('Y-m-d', strtotime('+1 year'));
        $licencia->foto='';
        $licencia->hora=date('H:i:s');
        $licencia->fechalimite=$tramite->fechalimite;
        $licencia->tipo=$tramite->tipo;
        $licencia->estado='ACTIVO';
//        $licencia->entramite=$request->entramite;
        $licencia->user_id=$request->user()->id;
        $licencia->contribuyente_id=$tramite->contribuyente_id;
        $licencia->caso_id=$tramite->caso_id;
        $licencia->tramite_id=$tramite->id;
        $licencia->save();
        return $licencia;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function show(Licencia $licencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Licencia $licencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licencia $licencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Licencia  $licencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licencia $licencia)
    {
        //
    }
}
