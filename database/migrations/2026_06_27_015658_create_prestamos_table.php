<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {

            $table->id();

            $table->string('nombre_estudiante');

            $table->date('fecha_prestamo');

            $table->date('fecha_devolucion');

            $table->foreignId('libro_id')->constrained('libros');

            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};