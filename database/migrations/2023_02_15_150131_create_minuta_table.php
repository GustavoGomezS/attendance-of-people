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
        Schema::create('minuta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario');
            $table->foreign('usuario', 'fk_minuta_users')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->string('comentario', 500);
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
        Schema::dropIfExists('minuta');
    }
};
