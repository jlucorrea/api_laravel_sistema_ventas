<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use App\Http\Resources\ArticuloCollection;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulo = Articulo::where('estado', 1)->get();
		return new ArticuloCollection($articulo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'nombre' => 'required'
		]);
		$id = $request->input('id');
		$articulo = Articulo::firstOrNew(['id' => $id]);
		$articulo->fill($request->all());
		$articulo->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Registro Exitoso' : 'Registro Actualizado'
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
		$articulo->marca = optional($articulo->marca)->nombre;
		$articulo->medida = optional($articulo->medida)->nombre;
		$articulo->categoria = optional($articulo->categoria)->nombre;
        return $articulo;
    }
	
    public function destroy(Articulo $articulo)
    {
		$articulo->update([
			'estado' => 0
		]);
		return response()->json([
			'success' => true,
			'message' => 'Registro Eliminado'
		]);
    }
}