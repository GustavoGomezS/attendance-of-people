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
        Schema::create('residente', function (Blueprint $table) {
            $table->id();
            $table->string('documentoResidente', 15);
            $table->string('nombreResidente', 40);
            $table->string('apellidoResidente', 40);
            $table->string('fotoResidente')->nullable($value = 'true');
            $table->unsignedBigInteger('localidad');
            $table->foreign('localidad', 'fk_residente_localidad')->references('id')->on('localidad')->onDelete('restrict')->onUpdate('restrict');
            $table->string('telefonoResidente', 15);
            $table->unsignedBigInteger('estadoResidente');
            $table->foreign('estadoResidente', 'fk_residente_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict')->default("3");
            $table->string('sexoResidente', 8);
            $table->date('fechaNacimientoResidente', $precision = 0);
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
        Schema::dropIfExists('residente');
    }
};
