<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InventarioCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($row, $key){

			$ingresos = $row->inventario->where('tipo',1)->sum('cantidad');
			$egresos = $row->inventario->where('tipo',2)->sum('cantidad');
			$stock = $ingresos - $egresos;
			$valorizado = $stock * $row->venta;
			$inversion = $stock * $row->compra;
			$UrlImage = $row->articuloimage->first();

			return [
				'id' => $row->id,
				'nombre' => $row->nombre,
				'barra' => $row->barra,
				'compra' => $row->compra,
				'venta' => $row->venta,
				'stock_minimo' => $row->stock_minimo,
				'marca' => optional($row->marca)->nombre,
				'medida' => optional($row->medida)->nombre,
				'code_unidad' => optional($row->medida)->codigo,
				'categoria' => optional($row->categoria)->nombre,
				'inventarios' => $row->inventario()->where('estado',1)->get(),
				'image' => $UrlImage ? $UrlImage->image->urlimage() : '',
				'ingresos' => $ingresos,
				'egresos' => $egresos,
				'stock' => $stock,
				'valorizado' => $valorizado,
				'inversion' => $inversion,
				'ganancia' => $valorizado - $inversion
			];
		});
    }
}
