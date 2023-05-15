<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_funcionario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario')->nullable();;
            $table->foreign('funcionario', 'fk_registroFuncionario_funcionario')->references('id')->on('funcionario')->onDelete('restrict')->onUpdate('restrict');   
            $table->unsignedBigInteger('nuevoEstado');
            $table->foreign('nuevoEstado', 'fk_registroFuncionario_estadoFuncionario')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');   
            $table->date("fecha");
            $table->time("hora");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_funcionario');
    }
};
