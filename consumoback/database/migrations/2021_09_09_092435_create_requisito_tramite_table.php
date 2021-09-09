<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitoTramiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisito_tramite', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisito_id');
            $table->foreign('requisito_id')->references('id')->on('requisitos');
            $table->unsignedBigInteger('tramite_id');
            $table->foreign('tramite_id')->references('id')->on('tramites');
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
        Schema::dropIfExists('requisito_tramite');
    }
}
