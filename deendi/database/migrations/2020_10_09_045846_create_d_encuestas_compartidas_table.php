<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDEncuestasCompartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_encuestas_compartidas', function (Blueprint $table) {
            $table->id();
            $table->string('destinatario');
            $table->string('asunto');
            $table->unsignedBigInteger('encuesta_id');
            $table->foreign('encuesta_id')->references('id')->on('d_encuestas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_remitente');
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
        Schema::dropIfExists('d_encuestas_compartidas');
    }
}
