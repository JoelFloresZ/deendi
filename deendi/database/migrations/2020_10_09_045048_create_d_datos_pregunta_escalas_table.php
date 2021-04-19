<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDDatosPreguntaEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_datos_pregunta_escalas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_res');
            $table->integer('rango');
            $table->integer('valor');
            $table->char('analizar_dato',10);
            $table->unsignedBigInteger('pregunta_id');
            $table->foreign('pregunta_id')->references('id')->on('d_preguntas')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('estado')->default(1);
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
        Schema::dropIfExists('d_datos_pregunta_escalas');
    }
}
