<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Resources\InventarioResource;
use App\Http\Resources\InventarioCollection;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$articulo = Articulo::where('estado', 1)->get();
		return new InventarioCollection($articulo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
		$inventario = Inventario::firstOrNew(['id' => $id]);
		$inventario->fill($request->all());
		$inventario->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Ajuste Exitoso' : 'Ajuste Registrado'
		]);
    }

    /**
     * Display the specified resource.
     */
    public function kardex($id)
    {
		$articulo = new InventarioResource(Articulo::where('estado',1)->findOrFail($id));
        return $articulo;
    }

	public function show($id)
    {
		$articulo = new InventarioResource(Articulo::where('estado',1)->findOrFail($id));
        return $articulo;
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->update([
			'estado' => 0
		]);

		return response()->json([
			'success' => true,
			'message' => 'Ajuste Eliminado'
		]);
    }
}
