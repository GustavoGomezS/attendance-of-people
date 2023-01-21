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
        Schema::create('visitante', function (Blueprint $table) {
            $table->id();
            $table->string('documentoVisitante', 15)->unique();
            $table->string('nombreVisitante', 40);
            $table->string('apellidoVisitante', 40);
            $table->string('fotoVisitante')->nullable($value = 'true');
            $table->string('telefonoVisitante', 15);
            $table->unsignedBigInteger('estadoVisitante');
            $table->foreign('estadoVisitante', 'fk_visitante_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict')->default("3");
            $table->string('sexoVisitante', 8);
            $table->date('fechaNacimientoVisitante', $precision = 0);
            $table->unsignedBigInteger('localidadVisita')->nullable();
            $table->foreign('localidadVisita', 'fk_visitante_localidad')->references('id')->on('localidad')->onDelete('restrict')->onUpdate('restrict');
            $table->string('comentarioVisitante', 200)->nullable($value = 'true');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitante');
    }
};
