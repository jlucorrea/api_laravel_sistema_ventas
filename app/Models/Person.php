<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;
	protected $table = 'persons';
	protected $with = ['identity_document'];

	protected $fillable = [
		'identity_document_id',
		'name',
		'razon_name',
		'document',
		'email',
		'phone',
		'address',
		'country_id',
		'department_id',
		'province_id',
		'district_id',
		'estado'
	];

	public function identity_document()
    {
        return $this->belongsTo(IdentityDocument::class, 'identity_document_id');
    }

	protected function name(): Attribute
	{
		return new Attribute(
			set: fn ($value) => ucwords($value)
		);
	}

	protected function razonName(): Attribute
	{
		return new Attribute(
			set: fn ($value) => ucwords($value)
		);
	}

	protected function email(): Attribute
	{
		return new Attribute(
			set: fn ($value) => strtolower($value)
		);
	}

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function department()
	{
		return $this->belongsTo(Department::class);
	}
	public function province()
	{
		return $this->belongsTo(Province::class);
	}
	public function district()
	{
		return $this->belongsTo(District::class);
	}
}
