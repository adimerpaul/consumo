<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialmultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historialmultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detallemulta_id');
            $table->foreign('detallemulta_id')->references('id')->on('detallemultas');
            $table->integer('monto');
            $table->date('inicio');
            $table->date('fin');
            $table->string('estado')->default('PENDIENTE');
            $table->unsignedBigInteger('licencia_id');
            $table->foreign('licencia_id')->references('id')->on('licencias');
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
        Schema::dropIfExists('historialmultas');
    }
}
