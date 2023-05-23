<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

	protected $fillable = [
		'nombre',
		'barra',
		'compra',
		'venta',
		'stock_minimo',
		'estado',
		'marca_id',
		'medida_id',
		'categoria_id'
	];

	public function marca()
	{
		return $this->belongsTo(Marca::class);
	}

	public function medida()
	{
		return $this->belongsTo(Medida::class);
	}

	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	public function inventario(){
        return $this->hasMany(Inventario::class);
    }

	public function articuloimage()
	{
		return $this->hasMany(ArticuloImage::class)->with(['Image'])->where('estado',1)->orderBy('id','desc');
	}
}
