<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsuarioCollection extends ResourceCollection
{

    public function toArray(Request $request)
    {
		return $this->collection->transform(function ($row, $key){
			return [
				'id' => $row->id,
				'nombre' => $row->nombre,
				'username' => $row->username,
				'email' => $row->email,
				'tipo' => $row->tipo,
				'estado' => $row->estado
			];
		});
    }
}
