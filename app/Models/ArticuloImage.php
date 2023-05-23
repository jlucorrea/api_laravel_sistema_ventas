<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloImage extends Model
{
    use HasFactory;

	protected $table = 'articulo_images';
	
	protected $fillable = [
		'articulo_id',
		'image_id',
		'estado'
	];
	
	public function Image()
	{
		return $this->belongsTo(Image::class);
	}
}
