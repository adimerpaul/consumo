<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->string("nrotramite");
            $table->date("fecha");
            $table->date("fechalimite");
            $table->time("hora");
            $table->string("tipo"); // A  o  B
            $table->string("licencia")->nullable(); // nuemro licencia
            $table->string("estado"); //unidad q se encuentra
            $table->string("estado2")->default('INICIADO'); // Procedo anulado terminado
            $table->boolean("infraestructura")->default(true);
            $table->boolean("seguridad")->default(true);
            $table->boolean("medio")->default(true);
            $table->boolean("salubridad")->default(true);
            $table->string("tramitador");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('caso_id');
            $table->foreign('caso_id')->references('id')->on('casos');
            $table->unsignedBigInteger('negocio_id')->nullable();
            $table->foreign('negocio_id')->references('id')->on('negocios');
            $table->unsignedBigInteger('contribuyente_id')->nullable();
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
        Schema::dropIfExists('tramites');
    }
}
