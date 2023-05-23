<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
	
	protected $table = 'sucursals';
	protected $fillable = [
		'nombre',
		'direccion',
		'telefono',
		'documento',
		'impresora',
		'codigo',
		'impresora_url',
		'country_id',
		'department_id',
		'province_id',
		'district_id',
		'estado'
	];
}
