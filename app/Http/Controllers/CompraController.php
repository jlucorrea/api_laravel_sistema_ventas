<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CajaCompra;
use App\Models\Inventario;
use App\Inputs\PersonInput;
use Illuminate\Http\Request;
use App\Inputs\ArticuloInput;
use App\Models\DetalleCompra;
use App\Traits\InventarioTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CompraResource;

class CompraController extends Controller
{
	use InventarioTrait;
	
    public function index()
    {
		$compra = Compra::where('estado', 1)->get();
		$list = [];
		foreach($compra as $m){
			$list[] = $this->show($m);
		}
		return $list;
    }

    public function store(Request $request)
    {
		$compra = DB::transaction(function () use ($request) {
			$customer = PersonInput::set($request->input('customer_id'));
			$request['user_id'] = auth()->id();
			$request['customer'] = $customer;
			$compra = Compra::create($request->all());
			
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

				DetalleCompra::Create([
					'tipo_afectacion_igv_id' => 10,
					'articulo' => $value['articulo'],
					'cantidad' => $cantidad,
					'valor_unitario' => $valor_unitario,
					'porcentage_igv' => 18,
					'total_igv' => $total_igv,
					'total_value' => $sub_total,
					'precio_unitario' => $value['precio_unitario'],
					'total' => $total,
					'compra_id' => $compra->id,
					'articulo_id' => $value['id']
				]);

				$tipo = 1;
				$this->updateStock($compra, $articulo_id, $cantidad, $tipo);
			}

			if($request->caja_id){
				CajaCompra::create([
					'caja_id' => $request->caja_id,
					'compra_id' => $compra->id,
					'monto' => $request->total
				]);
			}
		});
		return [
            'success' => true,
            'message'=> "Compra Registrada",
			'id' => $compra
        ];
    }

	public function record($id)
	{
		$compra = new CompraResource(Compra::with('detallecompra')->where('estado',1)->findOrFail($id));
		return $compra;
	}

    public function show(Compra $compra)
    {
		$compra->compra_inventario = $compra->comprainventario()->with(['inventario' => function($i){
			$i->with(['articulo' => function($a){
				$a->with(['marca','categoria','medida']);
			}]);
		}])->get();
		$compra->fecha = $compra->created_at->format('Y-m-d');
        return $compra;
    }

    public function update(Request $request, compra $compra)
    {
        
    }

    public function destroy($id)
    {
		try {
			DB::beginTransaction();

			$compra = Compra::find($id);

			$compra->update(['estado' => 0]);

			$compraItem = $compra->detallecompra()->get();

			foreach($compraItem as $item) { 
				$item->update(['estado' => 0]);
			}

			$compra->cajacompra->update(['estado' => 0]);

			$compraInventario = $compra->comprainventario()->get();

			foreach($compraInventario as $vInventatio) {
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
