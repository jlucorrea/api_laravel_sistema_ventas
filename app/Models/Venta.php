<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
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
		'tipo_cambio',
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

	public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }

	public function ventainventario()
	{
		return $this->hasMany(VentaInventario::class);
	}

	public function detalleventa()
    {
        return $this->hasMany(DetalleVenta::class);
    }

	public function cajaventa()
	{
		return $this->hasOne(CajaVenta::class);
	}

	public function customer()
    {
        return $this->belongsTo(Person::class, 'customer_id');
    }
}
