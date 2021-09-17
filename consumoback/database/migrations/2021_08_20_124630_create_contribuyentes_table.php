<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContribuyentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuyentes', function (Blueprint $table) {
            $table->id();
            $table->string("padron")->nullable()->default("");
            $table->string("representante")->nullable()->default("");
            $table->string("razon")->nullable()->default("");
            $table->string("cedula")->nullable()->default("");
            $table->string("expedido")->nullable()->default("");
            $table->string("telefono")->nullable()->default("");
            $table->string("direccion")->nullable()->default("");
            $table->string("direccionrazon")->nullable()->default("");
//            $table->string("celular")->nullable()->default("");
            $table->string("cargo")->nullable()->default("");
            $table->string("tipo")->nullable()->default("");
            $table->string("mts2")->nullable()->default("");
            $table->string("gest")->nullable()->default("");
            $table->string("ruc")->nullable()->default("");
            $table->string("descripcion")->nullable()->default("");

            $table->string("actividad")->nullable()->default("");
            $table->string("sector")->nullable()->default("");
            $table->string("nombre")->nullable()->default("");
            $table->string("descripcionactividad")->nullable()->default("");
            $table->string("horario")->nullable()->default("");
            $table->string("datospropietario")->nullable()->default("");
            $table->string("calle")->nullable()->default("");
            $table->string("numero")->nullable()->default("");
            $table->string("telefono")->nullable()->default("");
            $table->string("casilla")->nullable()->default("");
            $table->string("fax")->nullable()->default("");
            $table->string("extrangero")->nullable()->default("");
            $table->string("numeroextrangero")->nullable()->default("");
            $table->string("numerodni")->nullable()->default("");

            $table->string("zona")->nullable()->default("");
            $table->string("barrio")->nullable()->default("");
            $table->string("avenida")->nullable()->default("");
            $table->string("calleactividad")->nullable()->default("");
            $table->string("entrecalles")->nullable()->default("");

            $table->string("numpiso")->nullable()->default("");
            $table->string("numeroagua")->nullable()->default("");
            $table->string("numeroelectrico")->nullable()->default("");
            $table->string("observaciones")->nullable()->default("");

            $table->string("fachada")->nullable()->default("");
            $table->string("acera")->nullable()->default("");
            $table->string("iluminacion")->nullable()->default("");
            $table->string("letrero")->nullable()->default("");
            $table->string("datoestablecimiento")->nullable()->default("");

            $table->unique(['cedula','padron'],'cont_padron');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contribuyentes');
    }
}
