<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

	protected $fillable = [
		'motivo',
		'articulo_id',
		'compra',
		'venta',
		'cantidad',
		'tipo',
		'estado'
	];

	public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}
}