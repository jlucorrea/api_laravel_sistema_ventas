<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use App\Http\Resources\CajaResource;
use App\Http\Resources\CajaCollection;

class CajaController extends Controller
{
    public function index()
    {
		$caja = Caja::orderBy('id','desc')->get();
		$cajaResource = new CajaCollection($caja);
		return $cajaResource;
    }

    public function store(Request $request)
    {
		$id = $request->input('id');
		
		$caja = Caja::firstOrNew(['id' => $id]);
		$caja->user_id = $request->user_id;
		!$id ? $caja->save() : $caja->update(['estado' => 0]);

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Caja aperturada' : 'Caja cerrada con exito',
			'id' => $id,
		]);
    }

	public function show($id)
	{
		$caja = Caja::where('user_id', $id)->where('estado', 1)->first();

		if ($caja) {
			return $caja;
		} else {
			return response()->json(['message' => 'No se encontró ninguna caja abierta para este usuario'], 404);
		}
	}

	public function records($id)
	{
		$caja = Caja::where('user_id', $id)->where('estado', 1)->first();

		if ($caja) {
			$cajaResource = new CajaResource($caja);
			return $cajaResource;
		} else {
			return response()->json(['message' => 'No se encontró ninguna caja abierta para este usuario'], 404);
		}
	}
}
