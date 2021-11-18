<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Contribuyente;
use App\Models\Tramite;
use App\Models\Seguimiento;
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
        //return $request->contribuyente;
        if($request->contribuyente['id']==null || $request->contribuyente['id']==''){
            $contrib= new Contribuyente;
            $contrib->nombres=$request->contribuyente['nombres']!=""?$request->contribuyente['nombres']:'';
            $contrib->paterno=$request->contribuyente['paterno']!=""?$request->contribuyente['paterno']:'';
            $contrib->materno=$request->contribuyente['materno']!=""?$request->contribuyente['materno']:'';
            $contrib->esposo=$request->contribuyente['esposo']!=""?$request->contribuyente['esposo']:'';
            $contrib->cedula=$request->contribuyente['cedula']!=""?$request->contribuyente['cedula']:'';
            $contrib->expedido=$request->contribuyente['expedido']!=""?$request->contribuyente['expedido']:'';
            $contrib->telefono=$request->contribuyente['telefono']!=""?$request->contribuyente['telefono']:'';
            $contrib->telofi=$request->contribuyente['telofi']!=""?$request->contribuyente['telofi']:'';
            $contrib->domicilio=$request->contribuyente['domicilio']!=""?$request->contribuyente['domicilio']:'';
            $contrib->calle=$request->contribuyente['calle']!=""?$request->contribuyente['calle']:'';
            $contrib->numero=$request->contribuyente['numero']!=""?$request->contribuyente['numero']:'';
            $contrib->casilla=$request->contribuyente['casilla']!=""?$request->contribuyente['casilla']:'';
            $contrib->fax=$request->contribuyente['fax']!=""?$request->contribuyente['fax']:'';
            $contrib->extrangero=$request->contribuyente['extrangero']!=""?false:true;
            $contrib->numeroextrangero=$request->contribuyente['numeroextrangero']!=""?$request->contribuyente['numeroextrangero']:'';
            $contrib->numerodni=$request->contribuyente['numerodni']!=""?$request->contribuyente['numerodni']:'';
            $contrib->zona=$request->contribuyente['zona']!=""?$request->contribuyente['zona']:'';
            $contrib->nit=$request->contribuyente['nit']!=""?$request->contribuyente['nit']:'';
            $contrib->save();
            $cid=$contrib->id;
        }
        else $cid=$request->contribuyente['id'];
        $request->tramite['id'];
        foreach ($request->requisito as $r) {
           // return $r['id'];
            if($r['estado']){
            DB::table('requisito_tramite')->insert(['requisito_id'=>$r['id'],'tramite_id'=>$request->tramite['id']]);
            }
        }

        $negocio= new Negocio;
        //$negocio->actividad_id=$request->negocio['actividad']!=""?$request->negocio['actividad']:'';
        //$negocio->sector_id=$request->negocio['sector']!=""?$request->negocio['sector']:'';
        $negocio->razon=$request->negocio['razon']!=""?$request->negocio['razon']:'';
        $negocio->descripcionactividad=$request->negocio['descripcionactividad']!=""?$request->negocio['descripcionactividad']:'';
        $negocio->telefono=$request->negocio['telefono']!=""?$request->negocio['telefono']:'';
        $negocio->numpiso=$request->negocio['numpiso']!=""?$request->negocio['numpiso']:'';
        //$negocio->horario=$request->negocio['horario']!=""?$request->negocio['horario']:'';
        $negocio->mts2=$request->negocio['mts2']!=""?$request->negocio['mts2']:'';

        $negocio->zona=$request->negocio['zona']!=""?$request->negocio['zona']:'';
        $negocio->barrio=$request->negocio['barrio']!=""?$request->negocio['barrio']:'';
        $negocio->calle=$request->negocio['calle']!=""?$request->negocio['calle']:'';
        $negocio->entrecalles=$request->negocio['entrecalles']!=""?$request->negocio['entrecalles']:'';
        $negocio->numeroagua=$request->negocio['numeroagua']!=""?$request->negocio['numeroagua']:'';
        $negocio->numeroelectrico=$request->negocio['numeroelectrico']!=null?$request->negocio['numeroelectrico']:'';
        $negocio->observacion=$request->negocio['observacion']!=""?$request->negocio['observacion']:'';

        $negocio->fachada=$request->negocio['fachada']!=null?$request->negocio['fachada']:false;
        $negocio->acera=$request->negocio['acera']!=null?$request->negocio['acera']:false;
        $negocio->iluminacion=$request->negocio['iluminacion']!=null?$request->negocio['iluminacion']:false;
        $negocio->letrero=$request->negocio['letrero']!=null?$request->negocio['letrero']:false;

        $negocio->datoestablecimiento=$request->negocio['establecimiento']!=""?$request->negocio['establecimiento']:'';

        $negocio->tipo=$request->negocio['tipo']!=""?$request->negocio['tipo']:'';

        $negocio->contribuyente_id=$cid;
        $negocio->save();

        $tramite = Tramite::find($request->tramite['id']);
        $tramite->negocio_id=$negocio->id;
        $tramite->contribuyente_id=$cid;
        $tramite->estado='REGISTRADO';
        $tramite->save();

        $seguim= new Seguimiento;
        $seguim->nombre="REGISTRO DATOS";
        $seguim->observacion="REGISTRADO";
        $seguim->fecha=date("Y-m-d");
        $seguim->hora=date('H:i:s');
        $seguim->tramite_id=$tramite->id;
        $seguim->user_id=$request->user()->id;
        $seguim->save();

        return $tramite;

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
