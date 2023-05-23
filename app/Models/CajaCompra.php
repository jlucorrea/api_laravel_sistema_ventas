<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCompra extends Model
{
    use HasFactory;

	protected $fillable = [
		'caja_id',
		'compra_id',
		'monto',
		'estado'
	];

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}
}
