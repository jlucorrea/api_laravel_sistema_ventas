<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function (){
	Route::post('/login', 'UsuarioController@login');
	Route::apiResource('/usuarios', 'UsuarioController');
	
	Route::apiResource('/marcas', 'MarcaController');
	Route::apiResource('/medidas', 'MedidaController');
	Route::apiResource('/categorias', 'CategoriaController');
	Route::apiResource('/articulos', 'ArticuloController');
	Route::apiResource('/inventarios', 'InventarioController');
	Route::get('/inventarios/kardex/{articulo}', 'InventarioController@kardex');
	Route::apiResource('/compras', 'CompraController');
	Route::get('/compras/record/{id}', 'CompraController@record');
	Route::apiResource('/ventas', 'VentaController');
	Route::get('/ventas/record/{id}', 'VentaController@record');
	Route::apiResource('/sucursales', 'SucursalController');
	
});

Route::get('/', function () {
    return view('welcome');
});