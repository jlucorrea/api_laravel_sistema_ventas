<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcaResource extends JsonResource
{
    public function toArray(Request $request)
    {
		return [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'estado' => $this->estado
		];
    }
}
