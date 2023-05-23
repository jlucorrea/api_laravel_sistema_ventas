<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CajaMovimiento;

class CajaMovimientoController extends Controller
{

    public function index()
    {
        return CajaMovimiento::get();
    }

	public function store(Request $request)
	{
		try {
			CajaMovimiento::create($request->all());
			return response()->json(['success' => true,'message' => 'Registro creado correctamente']);
		} catch (\Throwable $th) {
			return response()->json(['errors' => 'Ocurrió un error al procesar la solicitud']);
		}
	}

    /**
     * Display the specified resource.
     */
    public function show(CajaMovimiento $CajaMovimiento)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CajaMovimiento $CajaMovimiento)
    {
        //
    }
}
