<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};
