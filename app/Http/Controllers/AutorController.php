<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return Autor::all();
    }

    public function store(Request $request)
    {
        return Autor::create($request->all());
    }

    public function show(Autor $autor)
    {
        return $autor;
    }

    public function update(Request $request, Autor $autor)
    {
        $autor->update($request->all());

        return $autor;
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();

        return response()->json([
            'mensaje' => 'Autor eliminado correctamente'
        ]);
    }
}