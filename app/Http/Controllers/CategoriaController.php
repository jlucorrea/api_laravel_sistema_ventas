<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$categoria = Categoria::where('estado',1)->get();
		return new CategoriaCollection($categoria);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$id = $request->input('id');
		$categoria = Categoria::firstOrNew(['id' => $id]);
		$categoria->fill($request->all());
		$categoria->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Registro Exitoso' : 'Registro Actualizado'
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return $categoria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
		$categoria->update($request->all());
		return $categoria;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
		$categoria->update([
			'estado' => 0
		]);
		
		return response()->json([
			'success' => true,
			'message' => 'Registro Eliminado'
		]);
    }
}
