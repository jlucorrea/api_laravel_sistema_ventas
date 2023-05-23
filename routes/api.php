<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/cajas', 'CajaController');
Route::get('/cajas/record/{id}', 'CajaController@show');
Route::get('/cajas/recordcaja/{id}', 'CajaController@records');
Route::apiResource('/cajamovimientos', 'CajaMovimientoController');
Route::post('/articuloImages/articulos/{articulo}', 'ArticuloImageController@store');
Route::get('/articuloImages/articulos/{articulo}', 'ArticuloImageController@show');
Route::delete('/articuloImages/articulos/delete/{id}', 'ArticuloImageController@delete');
Route::get('/dashboard', 'DashboardController@info');
