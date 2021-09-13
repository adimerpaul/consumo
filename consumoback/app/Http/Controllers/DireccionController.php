<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use App\Models\Tramite;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tramite::where('estado','DIRECCION TRIBUTARIA')
            ->with('user')
            ->with('caso')
            ->with('requisitos')
            ->with('contribuyente')
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
//        return $id;
        if ($id=='i'){
            return Tramite::where('estado','PROCESO')
                ->where('infraestructura',false)
                ->with('user')
                ->with('caso')
                ->with('requisitos')
                ->with('contribuyente')
                ->get();
        }
        if ($id=='s'){
            return Tramite::where('estado','PROCESO')
                ->where('seguridad',false)
                ->with('user')
                ->with('caso')
                ->with('requisitos')
                ->with('contribuyente')
                ->get();
        }
        if ($id=='m'){
            return Tramite::where('estado','PROCESO')
                ->where('medio',false)
                ->with('user')
                ->with('caso')
                ->with('requisitos')
                ->with('contribuyente')
                ->get();
        }
        if ($id=='sa'){
            return Tramite::where('estado','PROCESO')
                ->where('salubridad',false)
                ->with('user')
                ->with('caso')
                ->with('requisitos')
                ->with('contribuyente')
                ->get();
        }
        if ($id=='ac'){
            return Tramite::where('estado','PROCESO')
                ->where('infraestructura',true)
                ->where('salubridad',true)
                ->where('medio',true)
                ->where('salubridad',true)
                ->with('user')
                ->with('caso')
                ->with('requisitos')
                ->with('contribuyente')
                ->get();
        }

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
        $tramite=Tramite::find($id);
        $tramite->estado=$request->estado;
        if ($request->infraestructura)$tramite->infraestructura=$request->infraestructura;
        if ($request->seguridad)$tramite->seguridad=$request->seguridad;
        if ($request->medio)$tramite->medio=$request->medio;
        if ($request->salubridad)$tramite->salubridad=$request->salubridad;
        $tramite->save();
        $seguimiento= new Seguimiento();
        $seguimiento->nombre=$request->nombre;
        $seguimiento->observacion=$request->observacion;
        $seguimiento->fecha=date('Y-m-d');
        $seguimiento->hora=date('H:i:s');
        $seguimiento->tramite_id=$tramite->id;
        $seguimiento->user_id=$request->user()->id;
        $seguimiento->save();
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
