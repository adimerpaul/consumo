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
