<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraInventario extends Model
{
    use HasFactory;

	protected $table = 'compra_inventarios';

	protected $fillable = [
		'inventario_id',
		'compra_id',
		'precio',
		'cantidad',
		'estado'
	];

	public function inventario()
	{
		return $this->belongsTo(Inventario::class);
	}

	public function compra()
	{
		return $this->belongsTo(Compra::class);
	}
}
