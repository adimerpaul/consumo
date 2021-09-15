<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Contribuyente;
use App\Models\Tramite;
use App\Models\Seguimiento;

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
        //return $request;
        $verifica=Contribuyente::where('padron',trim($request->padron))->where('cedula',$request->ci)->get();
        //return count($verifica);
        if(count($verifica)>0) {
//            return 'aa';
            $contribuyente=$verifica[0];
        }else{
        if($request->tipo=='NATURAL'){

            $contrib=DB::connection('indcom')->table('natur')->where('npadron',$request->padron)->get()[0];

            $contribuyente=new Contribuyente;
            $contribuyente->padron=trim($contrib->npadron);
    	    $contribuyente->representante=trim($contrib->nombre).' '.trim($contrib->paterno).' '.trim($contrib->materno);
            $contribuyente->razon=$contrib->nactdescri;
	    	$contribuyente->cedula=trim($contrib->cedula);
            $contribuyente->expedido='';
            $contribuyente->telefono=$contrib->ntelefono;
	    	$contribuyente->direccion=$contrib->ndireccion;
            $contribuyente->direccionrazon=$contrib->ndiract;
		    $contribuyente->cargo='PROPIETARIO';
		    $contribuyente->tipo='N';
	        $contribuyente->mts2=$contrib->nmts2;
		    $contribuyente->gest=$contrib->gest;
	    	$contribuyente->ruc=$contrib->nruc;
	    	$contribuyente->descripcion=$contrib->nactdescri;
            $contribuyente->save();
        }
        else
            {$contrib=DB::connection('indcom')->table('jurid')->where('jpadron',$request->padron)->get()[0];
//            $contribuyente=new Contribuyente;
//            $contribuyente->padron=trim($contrib->jpadron);
//    	    $contribuyente->representante=$contrib->nombre.' '.$contrib->paterno.' '.$contrib->materno;
//            $contribuyente->razon=$contrib->nactdescri;
//	    	$contribuyente->cedula=trim($contrib->cedula);
//            $contribuyente->expedido='';
//            $contribuyente->telefono=$contrib->ntelefono;
//	    	$contribuyente->direccion=$contrib->ndireccion;
//            $contribuyente->direccionrazon=$contrib->diract;
//		    $contribuyente->cargo='PROPIETARIO';
//		    $contribuyente->tipo='N';
//	        $contribuyente->mts2=$contrib->nmts2;
//		    $contribuyente->gest=$contrib->gest;
//	    	$contribuyente->ruc=$contrib->nruc;
//	    	$contribuyente->descripcion=$contrib->nactdescri;
//            $contribuyente->save();

            $contribuyente=new Contribuyente;
            $contribuyente->padron=trim($contrib->jpadron);
    	    $contribuyente->representante=$contrib->nomreplega;
            $contribuyente->razon=$contrib->razon;
	    	$contribuyente->cedula=trim($contrib->numdociden);
            $contribuyente->expedido='';
            $contribuyente->telefono=$contrib->jtelefono;
	    	$contribuyente->direccion=$contrib->jdireccion;
            $contribuyente->direccionrazon=$contrib->jdiractiv;
		    $contribuyente->cargo=$contrib->cargo;
		    $contribuyente->tipo='J';
	        $contribuyente->mts2=$contrib->jmts2;
		    $contribuyente->gest=$contrib->gest;
	    	$contribuyente->ruc=$contrib->jruc;
	    	$contribuyente->descripcion=$contrib->jactdescri;
            $contribuyente->save();}
        }

        //return $contribuyente;
        $tramite=new Tramite;
        $tramite->nrotramite=$request->nrotramite;
         $tramite->tramitador=$request->tramitador;
         $tramite->fecha=date('Y-m-d');
         $tramite->hora=date('H:i:s');
         $tramite->fechalimite=date('Y-m-d', strtotime(' + 21 days'));
         $tramite->user_id=$request->user()->id;
         $tramite->estado="DIRECCION TRIBUTARIA";
          $tramite->estado2="EN PROCESO";
          $tramite->tipo=$request->tipo;
          $tramite->caso_id=$request->caso['id'];
          $tramite->contribuyente_id=$contribuyente->id;
          $tramite->padron=$request->padron;
          $tramite->nro="";
        $tramite->save();

        foreach ($request->requisitos as $row) {
            DB::table('requisito_tramite')->insert(['requisito_id'=>$row['id'],'tramite_id'=>$tramite->id]);
        }

        $seguim= new Seguimiento;
        $seguim->nombre="ENVIADO A DIRECCION TRIBUTARIA";
        $seguim->observacion="INICIADO";
        $seguim->fecha=date("Y-m-d");
        $seguim->hora=date('H:i:s');
        $seguim->tramite_id=$tramite->id;
        $seguim->user_id=$request->user()->id;
        return $seguim->save();


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
