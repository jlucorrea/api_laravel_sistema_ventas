<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caja extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'estado'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function cajamovimiento()
	{
		return $this->hasMany(CajaMovimiento::class);
	}

	public function cajaventas()
	{
		return $this->hasMany(CajaVenta::class)->where('estado',1);
	}

	public function cajacompras()
	{
		return $this->hasMany(CajaCompra::class)->where('estado',1);
	}
}
