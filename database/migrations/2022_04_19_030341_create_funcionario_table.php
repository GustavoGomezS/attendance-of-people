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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('documentoFuncionario', 15)->unique();
            $table->string('nombreFuncionario', 40);
            $table->string('apellidoFuncionario', 40);
            $table->string('fotoFuncionario')->nullable($value = 'true');
            $table->unsignedBigInteger('localidad')->nullable();
            $table->foreign('localidad', 'fk_Funcionario_localidad')->references('id')->on('localidad')->cascadeOnUpdate()->nullOnDelete();
            $table->string('telefonoFuncionario', 15);
            $table->unsignedBigInteger('estadoFuncionario');
            $table->foreign('estadoFuncionario', 'fk_funcionario_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict')->default("3");
            $table->unsignedBigInteger('poderAutorizar');
            $table->foreign('poderAutorizar', 'fk_funcionario_poderAutorizar')->references('id')->on('poder_autorizar')->onDelete('restrict')->onUpdate('restrict')->default("3");
            $table->string('sexoFuncionario', 8);
            $table->date('fechaNacimientoFuncionario', $precision = 0);
            $table->time('horaEntrada')->nullable();
            $table->time('horaSalida')->nullable();
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
        Schema::dropIfExists('funcionario');
    }
};
