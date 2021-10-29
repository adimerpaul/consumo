<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            
            $table->string("actividad")->nullable()->default("");
            $table->string("sector")->nullable()->default("");
            $table->string("licencia")->nullable()->unique();
            $table->string("razon")->nullable()->default("");
            $table->string("descripcionactividad")->nullable()->default("");
            $table->string("telefono")->nullable()->default("");
            $table->string("numero")->nullable()->default("");
            $table->string("direccion")->nullable()->default("");
            $table->string("numpiso")->nullable()->default("");
            $table->string("horario")->nullable()->default("");
            $table->string("mts2")->nullable()->default("");

            $table->string("zona")->nullable()->default("");
            $table->string("barrio")->nullable()->default("");
            $table->string("calle")->nullable()->default("");
            $table->string("entrecalles")->nullable()->default("");
            $table->string("numeroagua")->nullable()->default("");
            $table->string("numeroelectrico")->nullable()->default("");
            $table->string("observacion")->nullable()->default("");

            $table->boolean("fachada")->nullable();
            $table->boolean("acera")->nullable();
            $table->boolean("iluminacion")->nullable();
            $table->boolean("letrero")->nullable();

            $table->string("datoestablecimiento")->nullable()->default("");

            $table->string("tipo")->nullable()->default("");
            $table->string("gest")->nullable()->default("");
            $table->string("ruc")->nullable()->default("");

            $table->string("cargo")->nullable()->default("");
            $table->string("estado")->default("ACTIVO");
            $table->unsignedBigInteger('contribuyente_id');
            $table->foreign('contribuyente_id')->references('id')->on('contribuyentes');
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
        Schema::dropIfExists('negocios');
    }
}
