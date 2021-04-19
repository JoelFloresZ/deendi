<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDResultadoPreguntaEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_resultado_pregunta_escalas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encuesta_id');
            $table->foreign('encuesta_id')->references('id')->on('d_encuestas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('id')->on('d_preguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('respuesta');
            $table->integer('rango');
            $table->string('tipo_pregunta');
            $table->integer('num_encuesta_aplicado')->default(0);
            $table->integer('estado');
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
        Schema::dropIfExists('d_resultado_pregunta_escalas');
    }
}
