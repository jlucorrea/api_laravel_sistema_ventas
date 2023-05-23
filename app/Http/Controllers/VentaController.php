<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\CajaVenta;
use App\Models\Inventario;
use App\Inputs\PersonInput;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Inputs\ArticuloInput;
use App\Models\VentaInventario;
use App\Traits\InventarioTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\VentaResource;

class VentaController extends Controller
{
	use InventarioTrait;
	
    public function index()
    {
		$venta = Venta::where('estado', 1)->get();
		$list = [];
		foreach($venta as $m){
			$list[] = $this->show($m);
		}
		return $list;
    }

    public function store(Request $request)
    {
		$venta = DB::transaction(function () use ($request) {
			$customer = PersonInput::set($request->input('customer_id'));
			$request['user_id'] = auth()->id();
			$request['customer'] = $customer;
			$venta = Venta::create($request->all());
			
			foreach($request->items as $value){
				$articulo_id = $value['id'];
				$articulo = ArticuloInput::set($value['id']);
				$value['articulo'] = $articulo;
				$total = $value['total'] * $value['cantidad'];
				$cantidad = $value['cantidad'];
				$precio_unitario = $value['precio_unitario'];
				$valor_unitario = $precio_unitario / 1.18;
				$sub_total = $total / 1.18;
				$total_igv = $total - $sub_total;

				DetalleVenta::Create([
					'tipo_afectacion_igv_id' => 10,
					'articulo' => $value['articulo'],
					'cantidad' => $cantidad,
					'valor_unitario' => $valor_unitario,
					'porcentage_igv' => 18,
					'total_igv' => $total_igv,
					'total_value' => $sub_total,
					'precio_unitario' => $value['precio_unitario'],
					'total' => $total,
					'venta_id' => $venta->id,
					'articulo_id' => $value['id']
				]);

				$tipo = 2;
				$this->updateStock($venta, $articulo_id, $cantidad, $tipo);
			}
			if($request->caja_id){
				CajaVenta::create([
					'caja_id' => $request->caja_id,
					'venta_id' => $venta->id,
					'monto' => $request->total
				]);
			}
		});
		return [
            'success' => true,
            'message'=> "Venta Registrada",
			'id' => $venta
        ];
    }

	public function record($id)
	{
		$venta = new VentaResource(Venta::with('detalleventa')->where('estado',1)->findOrFail($id));
		return $venta;
	}

    public function show(Venta $venta)
    {
		$venta->ventainventario = $venta->ventainventario()->with(['inventario' => function($i){
			$i->with(['articulo' => function($a){
				$a->with(['marca','categoria','medida']);
			}]);
		}])->get();
		$venta->fecha = $venta->created_at->format('Y-m-d');
        return $venta;
    }

    public function destroy($id)
    {
		try {
			DB::beginTransaction();

			$venta = Venta::find($id);

			$venta->update(['estado' => 0]);

			$ventaItem = $venta->detalleventa()->get();

			foreach($ventaItem as $item) { 
				$item->update(['estado' => 0]);
			}

			$venta->cajaventa->update(['estado' => 0]);

			$ventaInventario = $venta->ventainventario()->get();

			foreach($ventaInventario as $vInventatio) {
				$vInventatio->update(['estado' => 0]);
				$InventarioDe = Inventario::where('id',$vInventatio->inventario_id)->get();
				foreach ($InventarioDe as $value) {
					$value->update(['estado' => 0]);
				}
			}

			DB::commit();

			return response()->json(['success' => true, 'message' => 'Registro eliminado']);

		} catch (\Throwable $th) {
			DB::rollBack();
			return response()->json(['success' => false, 'message' => 'Ocurrio un error al eliminar el registro: ' . $th->getMessage()]);
		}
    }
}