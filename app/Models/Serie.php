<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

	protected $fillable = [
		'sucursal_id',
		'serie',
		'number',
		'comprobante_id',
		'estado'
	];

	public function comprobante()
	{
		return $this->belongsTo(comprobante::class);
	}
}
