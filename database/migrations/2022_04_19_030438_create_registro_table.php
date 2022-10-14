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
            $table->string('ingresoSalida',10);
            $table->dateTime('fecha', $precision = 0);
            $table->unsignedBigInteger('puerta');
            $table->foreign('puerta','fk_registro_puerta')->references('id')->on('puerta')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('visitante');
            $table->foreign('visitante','fk_registro_visitante')->references('id')->on('visitante')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('localidad');
            $table->foreign('localidad','fk_registro_localidad')->references('id')->on('localidad')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('autorizaSeguridad');
            $table->foreign('autorizaSeguridad','fk_registro_users')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('autorizaResidente');
            $table->foreign('autorizaResidente','fk_registro_residente')->references('id')->on('residente')->onDelete('restrict')->onUpdate('restrict');
            $table->string('comentario',200);
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
