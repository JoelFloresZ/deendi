<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_preguntas', function (Blueprint $table) {
            $table->id();
            $table->text('pregunta');
            $table->char('tipo_pregunta',30);
            $table->char('analizar_dato', 5);
            $table->char('tipo_respuesta',20);
            $table->unsignedBigInteger('encuesta_id');
            $table->foreign('encuesta_id')->references('id')->on('d_encuestas')->onDelete('cascade')->onUpdate('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('d_preguntas');
    }
}
