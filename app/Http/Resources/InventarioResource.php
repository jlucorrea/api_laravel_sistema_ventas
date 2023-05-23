<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventarioResource extends JsonResource
{
    public function toArray(Request $request)
    {
		$ingresos = $this->inventario->where('tipo',1)->sum('cantidad');
		$egresos = $this->inventario->where('tipo',2)->sum('cantidad');
		$stock = $ingresos - $egresos;
		$valorizado = $stock * $this->venta;
		$inversion = $stock * $this->compra;
		$UrlImage = $this->articuloimage->first();

		return [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'barra' => $this->barra,
			'compra' => $this->compra,
			'venta' => $this->venta,
			'stock_minimo' => $this->stock_minimo,
			'marca' => optional($this->marca)->nombre,
			'medida' => optional($this->medida)->nombre,
			'code_unidad' => optional($this->medida)->codigo,
			'categoria' => optional($this->categoria)->nombre,
			'inventarios' => $this->inventario()->where('estado',1)->get(),
			'image' => $UrlImage ? $UrlImage->image->urlimage() : '',
			'ingresos' => $ingresos,
			'egresos' => $egresos,
			'stock' => $stock,
			'valorizado' => $valorizado,
			'inversion' => $inversion,
			'ganancia' => $valorizado - $inversion
		];
    }
}
