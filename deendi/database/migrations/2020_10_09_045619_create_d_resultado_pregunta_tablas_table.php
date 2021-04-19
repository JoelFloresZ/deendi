<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDResultadoPreguntaTablasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_resultado_pregunta_tablas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('encuesta_id');
            $table->foreign('encuesta_id')->references('id')->on('d_encuestas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('id')->on('d_preguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->char('tipo_pregunta',20);
            $table->integer('num_encuesta_aplicado')->default(0);
            $table->string('column1');
            $table->string('column2');
            $table->string('column3');
            $table->string('column4');
            $table->string('column5');
            $table->string('column6');
            $table->string('column7');
            $table->string('column8');
            $table->string('column9');
            $table->string('column10');
            $table->string('column11');
            $table->string('column12');
            $table->integer('num_columns');
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
        Schema::dropIfExists('d_resultado_pregunta_tablas');
    }
}
