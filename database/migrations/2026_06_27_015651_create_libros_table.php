<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {

            $table->id();

            $table->string('titulo');

            $table->string('isbn')->unique();

            $table->year('anio_publicacion');

            $table->integer('stock');

            $table->foreignId('autor_id')->constrained('autores');

            $table->foreignId('categoria_id')->constrained('categorias');

            $table->foreignId('editorial_id')->constrained('editoriales');

            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};