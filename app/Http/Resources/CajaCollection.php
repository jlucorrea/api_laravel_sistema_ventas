<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CajaCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
		return $this->collection->transform(function ($row, $key) {
			$ingresos = $row->cajamovimiento->where('tipo',1)->sum('monto');
			$salidas = $row->cajamovimiento->where('tipo',2)->sum('monto');
			$ventas = $row->cajaventas()->get()->sum('monto');
			$compras = $row->cajacompras()->get()->sum('monto');
			return [
				'id' => $row->id,
				'cajamovimiento' => isset($row->cajamovimiento) ? $row->cajamovimiento : null,
				'ingresos' => $ingresos,
				'salidas' => $salidas,
				'ventas' => $ventas,
				'compras' => $compras,
				'total' => floatval($ingresos + $ventas - $salidas - $compras),
				'estado' => $row->estado,
				'user' => $row->user,
				'fecha' => $row->created_at->format('Y-m-d')
			];
		});
    }
}