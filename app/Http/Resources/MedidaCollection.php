<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MedidaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($row, $key){
			return [
				'id' => $row->id,
				'codigo' => $row->codigo,
				'nombre' => $row->nombre,
				'estado' => $row->estado
			];
		});
    }
}
