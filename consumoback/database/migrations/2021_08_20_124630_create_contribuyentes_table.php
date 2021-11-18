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
            $table->string("nombres")->nullable()->default("");
            $table->string("paterno")->nullable()->default("");
            $table->string("materno")->nullable()->default("");
            $table->string("esposo")->nullable()->default("");
            $table->string("cedula")->nullable()->default("")->unique();
            $table->string("expedido")->nullable()->default("");
            $table->string("telefono")->nullable()->default("");
            $table->string("telofi")->nullable()->default("");
            $table->string("domicilio")->nullable()->default("");
            $table->string("calle")->nullable()->default("");
            $table->string("numero")->nullable()->default("");
            $table->string("casilla")->nullable()->default("");
            $table->string("fax")->nullable()->default("");
            $table->boolean("extrangero")->nullable()->default(false);
            $table->string("numeroextrangero")->nullable()->default("");
            $table->string("numerodni")->nullable()->default("");
            $table->string("zona")->nullable()->default("");
            $table->string("nit")->nullable()->default("");
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
