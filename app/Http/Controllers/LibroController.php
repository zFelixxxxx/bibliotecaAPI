<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        return Libro::all();
    }

    public function store(Request $request)
    {
        return Libro::create($request->all());
    }

    public function show(Libro $libro)
    {
        return $libro;
    }

    public function update(Request $request, Libro $libro)
    {
        $libro->update($request->all());

        return $libro;
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return response()->json([
            'mensaje' => 'Libro eliminado correctamente'
        ]);
    }
}