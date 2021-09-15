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
            $table->string("tipo");
            $table->string("padron");
            $table->string("estado");
            $table->string("estado2");
            $table->boolean("infraestructura")->default(false);
            $table->boolean("seguridad")->default(false);
            $table->boolean("medio")->default(false);
            $table->boolean("salubridad")->default(false);
            $table->string("nro")->default('')->nullable();
            $table->string("tramitador");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('caso_id');
            $table->foreign('caso_id')->references('id')->on('casos');
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
        Schema::dropIfExists('tramites');
    }
}
