<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::with([
            'autor',
            'categoria',
            'editorial',
            'prestamos',
        ])->get();

        return response()->json([
            'mensaje' => 'Lista de libros obtenida correctamente',
            'datos' => $libros
        ], 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:libros,isbn',
            'anio_publicacion' => 'required|integer|min:1000|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'autor_id' => 'required|exists:autores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'editorial_id' => 'required|exists:editoriales,id',
        ]);

        $libro = Libro::create($datos);

        $libro->load([
            'autor',
            'categoria',
            'editorial',
        ]);

        return response()->json([
            'mensaje' => 'Libro creado correctamente',
            'datos' => $libro
        ], 201);
    }

    public function show(Libro $libro)
    {
        $libro->load([
            'autor',
            'categoria',
            'editorial',
            'prestamos',
        ]);

        return response()->json([
            'mensaje' => 'Libro encontrado correctamente',
            'datos' => $libro
        ], 200);
    }

    public function update(Request $request, Libro $libro)
    {
        $datos = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'isbn' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('libros', 'isbn')->ignore($libro->id),
            ],
            'anio_publicacion' => 'sometimes|required|integer|min:1000|max:' . date('Y'),
            'stock' => 'sometimes|required|integer|min:0',
            'autor_id' => 'sometimes|required|exists:autores,id',
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'editorial_id' => 'sometimes|required|exists:editoriales,id',
        ]);

        $libro->update($datos);

        $libro->load([
            'autor',
            'categoria',
            'editorial',
        ]);

        return response()->json([
            'mensaje' => 'Libro actualizado correctamente',
            'datos' => $libro
        ], 200);
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return response()->json([
            'mensaje' => 'Libro eliminado correctamente'
        ], 200);
    }
}