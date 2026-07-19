<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('libros')->get();

        return response()->json([
            'mensaje' => 'Lista de categorías obtenida correctamente',
            'datos' => $categorias
        ], 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::create($datos);

        return response()->json([
            'mensaje' => 'Categoría creada correctamente',
            'datos' => $categoria
        ], 201);
    }

    public function show(Categoria $categoria)
    {
        $categoria->load('libros');

        return response()->json([
            'mensaje' => 'Categoría encontrada correctamente',
            'datos' => $categoria
        ], 200);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate([
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('categorias', 'nombre')->ignore($categoria->id),
            ],
            'descripcion' => 'sometimes|nullable|string',
        ]);

        $categoria->update($datos);

        return response()->json([
            'mensaje' => 'Categoría actualizada correctamente',
            'datos' => $categoria
        ], 200);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json([
            'mensaje' => 'Categoría eliminada correctamente'
        ], 200);
    }
}