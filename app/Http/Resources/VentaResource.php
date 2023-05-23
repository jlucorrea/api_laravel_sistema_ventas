<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VentaResource extends JsonResource
{
    public function toArray(Request $request)
    {
		return [
			'id' => $this->id,
			'articulos' => $this->detalleventa->map(function ($item, $key){
				return [
					'barra' => optional(json_decode($item->articulo))->barra,
					'nombre' => optional(json_decode($item->articulo))->nombre,
					'precio_unitario' => $item->precio_unitario,
					'cantidad' => $item->cantidad
				];
			}),
			'customer' => optional($this->customer)->name,
			'fecha' => optional($this->created_at)->format('Y-m-d'),
			'total' => $this->total
		];
    }
}