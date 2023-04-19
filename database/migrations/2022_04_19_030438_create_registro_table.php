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
        Schema::create('registro', function (Blueprint $table) {
            $table->id();
            $table->boolean('ingresoSalida');
            $table->unsignedBigInteger('puerta')->nullable();
            $table->foreign('puerta', 'fk_registro_puerta')->references('id')->on('puerta')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('visitante');
            $table->foreign('visitante', 'fk_registro_visitante')->references('id')->on('visitante')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('localidad')->nullable();
            $table->foreign('localidad', 'fk_registro_localidad')->references('id')->on('localidad')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('autorizaSeguridad');
            $table->foreign('autorizaSeguridad', 'fk_registro_users')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('autorizaFuncionario')->nullable();;
            $table->foreign('autorizaFuncionario', 'fk_registro_funcionario')->references('id')->on('funcionario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('comentario', 200)->nullable();
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
        Schema::dropIfExists('registro');
    }
};
