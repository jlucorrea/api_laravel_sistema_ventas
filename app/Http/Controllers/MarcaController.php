<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarcaCollection;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function index()
    {
        $marca = Marca::where('estado', 1)->get();
		return new MarcaCollection($marca);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
		$id = $request->input('id');
		$marca = Marca::firstOrNew(['id' => $id]);
		$marca->fill($request->all());
		$marca->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Registro Exitoso' : 'Registro Actualizado'
		]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return $marca;
    }

	public function destroy(Marca $marca)
    {
		$marca->update([
			'estado' => 0
		]);
		return response()->json([
			'success' => true,
			'message' => 'Registro Eliminado'
		]);
    }
}
