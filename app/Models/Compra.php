<?php

namespace App\Models;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compra extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'sucursal_id',
		'document_type_id',
		'series',
		'number',
		'customer_id',
		'customer',
		'currency_type_id',
		'status_paid',
		'total_igv',
		'total_value',
		'total',
		'estado'
	];

	protected $casts = [
        'date_of_issue' => 'date',
    ];

	public function getCustomerAttribute($value)
    {
        return (is_null($value)) ? null : (object)json_decode($value);
    }

	public function setCustomerAttribute($value)
    {
        $this->attributes['customer'] = (is_null($value)) ? null : json_encode($value);
    }

	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function person()
    {
        return $this->belongsTo(Patient::class, 'customer_id');
    }

	public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }

	public function comprainventario()
	{
		return $this->hasMany(CompraInventario::class);
	}

	public function detallecompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }

	public function cajacompra()
	{
		return $this->hasOne(CajaCompra::class);
	}

	public function proveedor()
    {
        return $this->belongsTo(Person::class, 'customer_id');
    }
}
