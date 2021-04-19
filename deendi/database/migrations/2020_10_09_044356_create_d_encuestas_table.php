<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_encuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->text('descripcion');
            $table->unsignedBigInteger('usuario_id')->default(1);
           /* $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');*/
            $table->char('estado_encuesta')->default('pendiente');
            $table->char('aplicado')->default('no');
            $table->integer('num_encuesta_aplicado')->default(0);
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
        Schema::dropIfExists('d_encuestas');
    }
}
