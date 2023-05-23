<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;
use App\Http\Resources\MedidaCollection;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medida = Medida::where('estado', 1)->get();
		return new MedidaCollection($medida);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$id = $request->input('id');
		$medida = Medida::firstOrNew(['id' => $id]);
        $medida->fill($request->all());
		$medida->save();
		return response()->json([
			'success' => true,
			'message' => !$id ? 'Rrgistro Exitoso' : 'Rrgistro Actualizado'
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        return $medida;
    }

    public function destroy(Medida $medida)
    {
		$medida->update([
			'estado' => 0
		]);
		return response()->json([
			'success' => true,
			'message' => 'Registro eliminado'
		]);
    }
}
