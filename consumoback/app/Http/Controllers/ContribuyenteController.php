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
    public function conregistro(Request $request){
//        return $request;
     if($request->tipo=='NATURAL'){
        return DB::connection('vutrat')->select('
            select *
            from v_seguim vs
            where n_tramite = (select n_tramite from v_tramites vt WHERE n_tramite=(select n_tramite from temp_naturales vn where pmc="'.$request->padron.'" and c_i="'.$request->ci.'" ))
            AND c_proce =8
            ');
        }
      else
        return DB::connection('vutrat')->select('select * from v_seguim vs where n_tramite = (select n_tramite from v_tramites vt WHERE n_tramite=(select n_tramite from temp_juridicas vj where pmc="'.$request->padron.'"  and c_i_rl="'.$request->ci.'" )) AND c_proce =8');

    }

    public function buscarcontrib($cedula){
        $buscar =DB::table('contribuyentes')->where('cedula',$cedula)->get();
        return $buscar;
    }

    public function conpagos(Request $request){
        $year = strtotime("1995-01-01");
        $end = strtotime(date('Y-m-d', strtotime("-1 year")));
        $lidgme=array();
        while($year <= $end)
        {
            $query=DB::connection('bases')->table('lidgic'.date('y', $year))
                ->whereNotNull('fech_pago')
                ->where('padron',trim($request->padron));
            if ($query->count()>0){
                array_push($lidgme,$query->get()[0]);
            }
//            echo date('y', $year).'----';
            $year = strtotime("+1 year", $year);

        }
        return $lidgme;
    }


    public function index()
    {
        return DB::connection('indcom')->select("
        SELECT TRIM(npadron) padron, concat(TRIM(paterno),' ',TRIM(materno),' ',TRIM(nombre),' CI',TRIM(cedula)) nombre,gest gestion , ndireccion dir, nactdescri des,'NATURAL' tipo, cedula ci
        FROM natur
        WHERE hab=0
        UNION
        SELECT TRIM(jpadron) padron, CONCAT(TRIM(nomreplega),' CI',TRIM(numdociden))  nombre,gest gestion, jdireccion dir, jactdescri des,'JURIDICO' tipo, numdociden ci
        FROM jurid
        WHERE hab=0
        ");
    }

    public function listadocontrib(){
        return DB::table('contribuyentes')
        ->where('estado','ACTIVO')->get();
    }

    
    public function buscarcon($dato){
//        return DB::connection('indcom')
//            ->table('natur')
//            ->where('paterno',$dato)
//            ->orWhere('materno',$dato)
//            ->orWhere('nombre',$dato)
//            ->get();
//            ->limit(10);
//        $array=explode(' ',$dato);
////        return count($array);
//        if (count($array)==1){
        return DB::connection('indcom')->select("
        SELECT npadron padron, concat(paterno,' ',materno,' ',nombre,' CI',cedula) nombre,gest gestion , ndireccion dir, nactdescri des,'NATURAL' tipo, cedula ci
        FROM natur
        WHERE hab=0
        AND concat(TRIM( npadron),' ',TRIM( paterno),' ',TRIM( materno),' ',TRIM( nombre))  like '%$dato%'
        UNION
        SELECT jpadron padron, CONCAT(nomreplega,' CI',numdociden)  nombre,gest gestion, jdireccion dir, jactdescri des,'JURIDICO' tipo, numdociden ci
        FROM jurid j
        WHERE hab=0
        AND concat(TRIM( jpadron),' ',TRIM(nomreplega)) like '%$dato%'
        LIMIT 10");

//        }



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

    public function listactividad($codigo){
        return DB::table('actividad')->where('codigo',$codigo)->get();
    }

    public function listsector($sector){
        return DB::table('sectores')->where('sector',$sector)->get();
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
