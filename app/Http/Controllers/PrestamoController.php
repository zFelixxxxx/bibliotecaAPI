<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        return Prestamo::all();
    }

    public function store(Request $request)
    {
        return Prestamo::create($request->all());
    }

    public function show(Prestamo $prestamo)
    {
        return $prestamo;
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $prestamo->update($request->all());

        return $prestamo;
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        return response()->json([
            'mensaje' => 'Préstamo eliminado correctamente'
        ]);
    }
}