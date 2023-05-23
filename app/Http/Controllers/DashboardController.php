<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function info()
	{
		return [
			'articulos' => Articulo::where('estado',1)->get()->count(),
			'users' => User::where('estado',1)->get()->count(),
			'compras' => Compra::where('estado',1)->get()->sum('total'),
			'ventas' => Venta::where('estado',1)->get()->sum('total'),
			'meses' => $this->ventaSemanalVentas(),
			'meses2' => $this->ventaSemanalCompras()
		];
	}

	public function ventaSemanalVentas()
	{
		$ventas = Venta::select(
			DB::raw('sum(total) as total'),
			DB::raw("DATE_FORMAT(created_at, '%M %Y') as mes")
		)->where('estado',1)->groupBy('mes')->limit(7)->get();

		return $ventas;
	}

	public function ventaSemanalCompras()
	{
		$compras = Compra::select(
			DB::raw('sum(total) as total'),
			DB::raw("DATE_FORMAT(created_at, '%M %Y') as mes")
		)->where('estado',1)->groupBy('mes')->limit(7)->get();

		return $compras;
	}
}
