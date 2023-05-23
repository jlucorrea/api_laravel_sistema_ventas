<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CajaResource extends JsonResource
{
    public function toArray(Request $request)
    {
		$ingresos = $this->cajamovimiento->where('tipo',1)->sum('monto');
		$salidas = $this->cajamovimiento->where('tipo',2)->sum('monto');
		$ventas = $this->cajaventas()->get()->sum('monto');
		$compras = $this->cajacompras()->get()->sum('monto');

		return [
			'id' => $this->id,
			'cajamovimiento' => isset($this->cajamovimiento) ? $this->cajamovimiento : null,
			'ingresos' => $ingresos,
			'salidas' => $salidas,
			'ventas' => $ventas,
			'compras' => $compras,
			'total' => floatval($ingresos + $ventas - $salidas - $compras),
			'estado' => $this->estado,
			'user' => $this->user
		];
    }
}