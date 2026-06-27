<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function index()
    {
        return Editorial::all();
    }

    public function store(Request $request)
    {
        return Editorial::create($request->all());
    }

    public function show(Editorial $editorial)
    {
        return $editorial;
    }

    public function update(Request $request, Editorial $editorial)
    {
        $editorial->update($request->all());

        return $editorial;
    }

    public function destroy(Editorial $editorial)
    {
        $editorial->delete();

        return response()->json([
            'mensaje' => 'Editorial eliminada correctamente'
        ]);
    }
}