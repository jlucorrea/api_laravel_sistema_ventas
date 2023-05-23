<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursal = Sucursal::where('estado', 1)->get();
		return $sucursal;
    }

    public function store(Request $request)
    {
		$id = $request->input('id');
		$sucursal = Sucursal::firstOrNew(['id' => $id]);
		$sucursal->fill($request->all());
		$sucursal->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Registro Exitoso' : 'Registro Actualizado',
		]);
    }

    public function destroy($id)
    {
		$sucursal = Sucursal::find($id);
		$sucursal->update(['estado' => 0]);
		
		return response()->json([
			'success' => true,
			'message' => 'Registo eliminado'
		]);

    }
}
