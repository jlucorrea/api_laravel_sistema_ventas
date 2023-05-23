<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaMovimiento extends Model
{
    use HasFactory;

	protected $fillable = [
		'motivo',
		'monto',
		'caja_id',
		'tipo',
		'estado'
	];

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}
}