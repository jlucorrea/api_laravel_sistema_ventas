<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaInventario extends Model
{
    use HasFactory;

	protected $table = 'venta_inventarios';

	protected $fillable = [
		'inventario_id',
		'venta_id',
		'precio',
		'cantidad',
		'estado'
	];

	public function inventario()
	{
		return $this->belongsTo(Inventario::class);
	}

	public function venta()
	{
		return $this->belongsTo(Venta::class);
	}
}
