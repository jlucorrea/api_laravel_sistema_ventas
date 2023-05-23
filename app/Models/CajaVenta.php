<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaVenta extends Model
{
    use HasFactory;

	protected $fillable = [
		'caja_id',
		'venta_id',
		'monto',
		'estado'
	];

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}
}
