<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDDatosPreguntaTablasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_datos_pregunta_tablas', function (Blueprint $table) {
            $table->id();
            $table->char('tipo_pregunta', 20);
            $table->integer('numero_columnas');
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
        Schema::dropIfExists('d_datos_pregunta_tablas');
    }
}
