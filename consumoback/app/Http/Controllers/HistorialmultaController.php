<?php

namespace App\Http\Controllers;

use App\Models\Historialmulta;
use App\Models\Licencia;
use Illuminate\Http\Request;

class HistorialmultaController extends Controller
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
        //
    }

    public function listahistorial($id){
        return Historialmulta::where('licencia_id',$id)->get();
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
        $historialmulta=new Historialmulta;
        $historialmulta->detallemulta_id=$request->detallemulta_id;
        $historialmulta->multa_id=$request->multa_id;
        $historialmulta->monto=$request->monto;
        $historialmulta->fecha=date('Y-m-d');
        if($request->dia=='INDEFINIDO'){
            $historialmulta->inicio=date('Y-m-d');
            $historialmulta->fin=date('9999-12-31');
            $lic=Licencia::find($request->licencia_id);
            $lic->estado='CLAUSURA';
            $lic->save();
        }
        
        if(is_numeric($request->dia) && intval($request->dia)>0){
            $historialmulta->inicio=date('Y-m-d');
            $cdia=intval($request->dia);
            $historialmulta->fin=date('Y-m-d', strtotime("+$cdia day"));
            $lic=Licencia::find($request->licencia_id);
            $lic->estado='SUSPENCION';
            $lic->save();
        }
        $historialmulta->observacion=$request->observacion;
        $historialmulta->licencia_id=$request->licencia_id;
        $historialmulta->save();
        return $historialmulta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historialmulta  $historialmulta
     * @return \Illuminate\Http\Response
     */
    public function show(Historialmulta $historialmulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historialmulta  $historialmulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Historialmulta $historialmulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historialmulta  $historialmulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Historialmulta $historialmulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historialmulta  $historialmulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historialmulta $historialmulta)
    {
        //
    }
}
