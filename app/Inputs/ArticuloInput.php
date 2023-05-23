<?php

namespace App\Inputs;

use App\Models\Articulo;

class ArticuloInput
{
    public static function set($articulo_id)
    {
        $articulo =  Articulo::find($articulo_id);

        if(!$articulo) {
            return null;
        }
        return [
            'barra' => $articulo->barra,
			'nombre' => $articulo->nombre,
			'compra' => $articulo->compra,
            'stock_minimo' => $articulo->stock_minimo,
            'medida_id' => $articulo->medida_id
        ];
    }
}
