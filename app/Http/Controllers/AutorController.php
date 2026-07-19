<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::with('libros')->get();

        return response()->json([
            'mensaje' => 'Lista de autores obtenida correctamente',
            'datos' => $autores
        ], 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $autor = Autor::create($datos);

        return response()->json([
            'mensaje' => 'Autor creado correctamente',
            'datos' => $autor
        ], 201);
    }

    public function show(Autor $autor)
    {
        $autor->load('libros');

        return response()->json([
            'mensaje' => 'Autor encontrado correctamente',
            'datos' => $autor
        ], 200);
    }

    public function update(Request $request, Autor $autor)
    {
        $datos = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'nacionalidad' => 'sometimes|required|string|max:255',
            'fecha_nacimiento' => 'sometimes|nullable|date',
        ]);

        $autor->update($datos);

        return response()->json([
            'mensaje' => 'Autor actualizado correctamente',
            'datos' => $autor
        ], 200);
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();

        return response()->json([
            'mensaje' => 'Autor eliminado correctamente'
        ], 200);
    }
}