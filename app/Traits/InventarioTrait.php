<?php
namespace App\Traits;

use App\Models\Articulo;
use App\Models\Inventario;
use App\Models\CompraInventario;
use App\Models\VentaInventario;

trait InventarioTrait
{
	public function updateStock($compa, $articulo_id, $cantidad, $tipo)
	{
		$articulo = Articulo::find($articulo_id);
		
		$inventario = new Inventario();
		$inventario->motivo = $tipo == 1 ? 'Compra' : 'Venta';
		$inventario->articulo_id = $articulo->id;
		$inventario->compra = $articulo->compra;
		$inventario->venta = $articulo->venta;
		$inventario->cantidad = $cantidad;
		$inventario->tipo = $tipo;
		
		$inventario->save();

		if($tipo== 1){
			CompraInventario::create([
				'inventario_id' => $inventario->id,
				'compra_id' => $compa->id,
				'precio' => $articulo->compra,
				'cantidad' => $cantidad
			]);
		}else{
			VentaInventario::create([
				'inventario_id' => $inventario->id,
				'venta_id' => $compa->id,
				'precio' => $articulo->venta,
				'cantidad' => $cantidad
			]);
		}
	}

}