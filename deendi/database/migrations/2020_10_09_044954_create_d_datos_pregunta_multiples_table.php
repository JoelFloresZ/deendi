<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDDatosPreguntaMultiplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_datos_pregunta_multiples', function (Blueprint $table) {
            $table->id();
            $table->string('opcion');
            $table->string('tipo_opcion');
            $table->char('opcion_otra',50);
            $table->char('analizar_dato',5);
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('id')->on('d_preguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('d_datos_pregunta_multiples');
    }
}
