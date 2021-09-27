<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobromultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobromultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('licencia_id');
            $table->foreign('licencia_id')->references('id')->on('licencias');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('historialmulta_id');
            $table->foreign('historialmulta_id')->references('id')->on('historialmultas');
            $table->date('fecha');
            $table->double('monto',11,2);
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
        Schema::dropIfExists('cobromultas');
    }
}
