<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditorialController extends Controller
{
    public function index()
    {
        $editoriales = Editorial::with('libros')->get();

        return response()->json([
            'mensaje' => 'Lista de editoriales obtenida correctamente',
            'datos' => $editoriales
        ], 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:editoriales,nombre',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
        ]);

        $editorial = Editorial::create($datos);

        return response()->json([
            'mensaje' => 'Editorial creada correctamente',
            'datos' => $editorial
        ], 201);
    }

    public function show(Editorial $editorial)
    {
        $editorial->load('libros');

        return response()->json([
            'mensaje' => 'Editorial encontrada correctamente',
            'datos' => $editorial
        ], 200);
    }

    public function update(Request $request, Editorial $editorial)
    {
        $datos = $request->validate([
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('editoriales', 'nombre')->ignore($editorial->id),
            ],
            'direccion' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:30',
        ]);

        $editorial->update($datos);

        return response()->json([
            'mensaje' => 'Editorial actualizada correctamente',
            'datos' => $editorial
        ], 200);
    }

    public function destroy(Editorial $editorial)
    {
        $editorial->delete();

        return response()->json([
            'mensaje' => 'Editorial eliminada correctamente'
        ], 200);
    }
}