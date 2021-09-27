<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallemultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallemultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multa_id');
            $table->foreign('multa_id')->references('id')->on('multas');
            $table->string('titulo');
            $table->string('monto');
            $table->string('dias');
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
        Schema::dropIfExists('detallemultas');
    }
}
