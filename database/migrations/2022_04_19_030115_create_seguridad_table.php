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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('documentoUsuario', 15);
            $table->string('name', 20);
            $table->string('last_name', 20);
            $table->unsignedBigInteger('tipoUsuario');
            $table->foreign('tipoUsuario', 'fk_usuario_tipoUsuario')->references('id')->on('tipo_usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('estadoUsuario');
            $table->foreign('estadoUsuario', 'fk_usuario_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
