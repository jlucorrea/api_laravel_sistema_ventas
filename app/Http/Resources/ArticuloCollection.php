<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticuloCollection extends ResourceCollection
{

    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($row, $key){
			return [
				'id' => $row->id,
				'nombre' => $row->nombre,
				'barra' => $row->barra,
				'compra' => $row->compra,
				'venta' => $row->venta,
				'stock_minimo' => $row->stock_minimo,
				'estado' => $row->estado,
				'marca' => optional($row->marca)->nombre,
				'medida' => optional($row->medida)->nombre,
				'categoria' => optional($row->categoria)->nombre,
			];
		});
    }
}
