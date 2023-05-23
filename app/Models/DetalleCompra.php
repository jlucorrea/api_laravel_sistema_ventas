<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
	protected $table = 'detalle_compra';
	public $timestamps = false;

	protected $fillable = [
		'tipo_afectacion_igv_id',
		'articulo',
		'cantidad',
		'valor_unitario',
		'porcentage_igv',
		'total_igv',
		'total_value',
		'precio_unitario',
		'total',
		'estado',
		'medida_id',
		'compra_id',
		'articulo_id'
	];

	public function getArticuloAtribute($value)
	{
		return (is_null($value))?null:(object) json_decode($value);
	}

	public function setArticuloAttribute($value)
    {
        $this->attributes['articulo'] = (is_null($value))?null:json_encode($value);
    }

	public function compra()
	{
		return $this->belongsTo(Compra::class);
	}

	public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}

	public function medida()
	{
		return $this->hasMany(Medida::class);
	}
	
}