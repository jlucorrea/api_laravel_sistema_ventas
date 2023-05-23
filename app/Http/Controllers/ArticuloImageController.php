<?php

namespace App\Http\Controllers;

use App\Models\ArticuloImage;
use App\Models\Image;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticuloImageController extends Controller
{

    public function store(Request $request, Articulo $articulo)
    {
		$file = $request->file('file')->store('public/articulos');
		$url = Storage::url($file);
		$image = new Image();
		$image->path = $url;
		$image->save();
		$ArticuloImage = new ArticuloImage();
		$ArticuloImage->articulo_id = $articulo->id;
		$ArticuloImage->image_id = $image->id;
		$ArticuloImage->save();

		return $ArticuloImage;
    }

    public function show(Articulo $articulo)
    {
		$articulo->articuloimage = $articulo->articuloimage()->get()->each(function($i){
			$i->url = $i->image->urlimage();
		});
        return $articulo;
    }

    public function delete($id)
    {
        $ArticuloImage = ArticuloImage::find($id);
		$ArticuloImage->update(['estado' =>0]);

		return response()->json([
			'success' => true,
			'message' => 'Imagen eliminada'
		]);
    }
}
