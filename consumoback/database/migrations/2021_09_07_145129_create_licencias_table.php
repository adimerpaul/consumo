<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            //$table->string('num');
            $table->string('num');
            $table->string('numlicencia');
            $table->date("fecha");
            $table->date("fechaautorizacion");
            $table->date("fechafin");
            $table->string("foto");
            $table->time("hora");
            $table->date("fechalimite");
            $table->string("tipo");
            $table->string("estado");
            $table->string("entramite")->default('')->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references('id')->on('users');
            $table->unsignedBigInteger("negocio_id");
            $table->foreign("negocio_id")->references('id')->on('negocios');
            $table->unsignedBigInteger("contribuyente_id");
            $table->foreign("contribuyente_id")->references('id')->on('contribuyentes');
            $table->unsignedBigInteger("caso_id");
            $table->foreign("caso_id")->references('id')->on('casos');
            $table->unsignedBigInteger("tramite_id");
            $table->foreign("tramite_id")->references('id')->on('tramites');
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
        Schema::dropIfExists('licencias');
    }
}
