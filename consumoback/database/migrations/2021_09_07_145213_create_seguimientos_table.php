<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('observacion');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger("tramite_id");
            $table->foreign("tramite_id")->references('id')->on('tramites');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references('id')->on('users');

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
        Schema::dropIfExists('seguimientos');
    }
}
