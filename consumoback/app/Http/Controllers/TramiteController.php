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

            $contrib=DB::connection('vutrat')->table('temp_naturales')->where('pmc',$request->padron)->where('c_i',$request->ci)->get();
            if(count($contrib)>0){
                $contrib=$contrib[0];
                $contribuyente=new Contribuyente;
                $contribuyente->padron=$contrib->pmc;
                $contribuyente->representante=trim($contrib->nombres).' '.trim($contrib->a_paterno).' '.trim($contrib->a_materno).' '.trim($contrib->a_esposo);
                $contribuyente->nombres=$contrib->nombres;
                $contribuyente->paterno=$contrib->a_paterno;
                $contribuyente->materno=$contrib->a_materno;
                $contribuyente->esposo=$contrib->a_esposo;

                $contribuyente->razon=$contrib->nom_acti;
                $contribuyente->cedula=$contrib->c_i;
                $contribuyente->expedido='';
                $contribuyente->telefono=$contrib->fono_dom;
                $contribuyente->direccion=$contrib->calle_dom;
                $contribuyente->direccionrazon=$contrib->act_c_av.' '.$contrib->act_e_ca;
                $contribuyente->cargo='PROPIETARIO';
                $contribuyente->tipo='N';
                $contribuyente->mts2=$contrib->superficie;
                $contribuyente->gest=date('Y', strtotime(date('Y-m-d'). ' -1 year'));
                $contribuyente->ruc=$contrib->nit;
                $contribuyente->descripcion=$contrib->descrip;

                $contribuyente->actividad=$contrib->cod_acti;
                $contribuyente->sector=$contrib->cod_sector;
                $contribuyente->nombreact=$contrib->nom_acti;
                $contribuyente->descripcionactividad=$contrib->descrip;
                $contribuyente->horario=$contrib->horario;
                $contribuyente->datospropietario='';
                $contribuyente->calle=$contrib->calle_dom;
                $contribuyente->numero='';
                $contribuyente->telefono=$contrib->act_fono;
                $contribuyente->casilla=$contrib->casilla;
                $contribuyente->fax=$contrib->fax;
                $contribuyente->extrangero=$contrib->extrangero;
                $contribuyente->numeroextrangero=$contrib->cert_ext;
                $contribuyente->numerodni=$contrib->n_dni;

                $contribuyente->zona=$contrib->act_zona;
                $contribuyente->barrio=$contrib->act_barrio;
                $contribuyente->calleactividad=$contrib->act_c_av;
                $contribuyente->entrecalles=$contrib->act_e_ca;

                $contribuyente->numpiso=$contrib->act_piso;
                $contribuyente->numeroagua=$contrib->n_medidor_a;
                $contribuyente->numeroelectrico=$contrib->n_medidor_e;
                $contribuyente->observaciones='';

                $contribuyente->fachada=$contrib->fachada;
                $contribuyente->acera=$contrib->acera;
                $contribuyente->iluminacion=$contrib->luz;
                $contribuyente->letrero=$contrib->letreros;
                $contribuyente->datoestablecimiento=$contrib->establec;
                $contribuyente->save();
            }
            else{
            $contrib=DB::connection('indcom')->table('natur')->where('npadron',$request->padron)->where('cedula',$request->ci)->get()[0];

            $contribuyente=new Contribuyente;
            $contribuyente->padron=trim($contrib->npadron);
    	    $contribuyente->representante=trim($contrib->nombre).' '.trim($contrib->paterno).' '.trim($contrib->materno);
    	    $contribuyente->nombres=trim($contrib->nombre);
    	    $contribuyente->paterno=trim($contrib->paterno);
    	    $contribuyente->materno=trim($contrib->materno);
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
        }}
        else
            {
                $contrib=DB::connection('vutrat')->table('temp_juridicas')->where('pmc',$request->padron)->where('c_i_rl',$request->ci)->get();
                if(count($contrib)>0){
                    $contrib=$contrib[0];
                    $contribuyente=new Contribuyente;
                    $contribuyente->padron=$contrib->pmc;
                    $contribuyente->representante=trim($contrib->nombres_rl).' '.trim($contrib->a_paterno_rl).' '.trim($contrib->a_materno_rl).' '.trim($contrib->a_esposo_rl);
                    $contribuyente->nombres=$contrib->nombres_rl;
                    $contribuyente->paterno=$contrib->a_paterno_rl;
                    $contribuyente->materno=$contrib->a_materno_rl;
                    $contribuyente->esposo=$contrib->a_esposo_rl;

                    $contribuyente->razon=$contrib->razon_social;
                    $contribuyente->cedula=$contrib->c_i_rl;
                    $contribuyente->expedido='';
                    $contribuyente->telefono=$contrib->fono_dom;
                    $contribuyente->direccion=$contrib->calle_dom;
                    $contribuyente->direccionrazon=$contrib->act_c_av.' '.$contrib->act_e_ca;
                    $contribuyente->cargo='PROPIETARIO';
                    $contribuyente->tipo='J';
//                    return $contrib;
                    $contribuyente->mts2=$contrib->superfice;
                    $contribuyente->gest=date('Y', strtotime(date('Y-m-d'). ' -1 year'));
                    $contribuyente->ruc=$contrib->nit;
                    $contribuyente->descripcion=$contrib->descrip;

                    $contribuyente->actividad=$contrib->cod_acti;
                    $contribuyente->sector=$contrib->cod_sector;
                    $contribuyente->nombreact=$contrib->razon_social;
                    $contribuyente->descripcionactividad=$contrib->descrip;
                    $contribuyente->horario=$contrib->horario;
                    $contribuyente->datospropietario='';
                    $contribuyente->calle=$contrib->calle_dom;
                    $contribuyente->numero=$contrib->n_dom;
                    $contribuyente->telefono=$contrib->fono_dom;
                    $contribuyente->casilla=$contrib->casilla;
                    $contribuyente->fax=$contrib->fax;
                    $contribuyente->extrangero=$contrib->boliviano;
                    $contribuyente->numeroextrangero=$contrib->cert_ext;
                    $contribuyente->numerodni=$contrib->n_dni;

                    $contribuyente->zona=$contrib->act_zona;
                    $contribuyente->barrio=$contrib->act_barrio;
                    $contribuyente->calleactividad=$contrib->act_c_av;
                    $contribuyente->entrecalles=$contrib->act_e_ca;

                    $contribuyente->numpiso=$contrib->act_piso;
                    $contribuyente->numeroagua=$contrib->n_medidor_a;
                    $contribuyente->numeroelectrico=$contrib->n_medidor_e;
                    $contribuyente->observaciones='';

                    $contribuyente->fachada=$contrib->fachada;
                    $contribuyente->acera=$contrib->acera;
                    $contribuyente->iluminacion=$contrib->luz;
                    $contribuyente->letrero=$contrib->letreros;
                    $contribuyente->datoestablecimiento=$contrib->establec;
                    $contribuyente->save();
            }
            else{

                $contrib=DB::connection('indcom')->table('jurid')->where('jpadron',$request->padron)->get()[0];

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
          $tramite->tipo=$request->caso['tipo'];
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
