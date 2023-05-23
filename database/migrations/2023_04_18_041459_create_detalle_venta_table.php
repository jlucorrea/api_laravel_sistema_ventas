<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_venta', function (Blueprint $table){
			$table->id();
			$table->string('tipo_afectacion_igv_id', 3);
			$table->json('articulo');
			$table->integer('cantidad');
			$table->decimal('valor_unitario', 12,5);
			$table->decimal('porcentage_igv', 12, 2)->default(18.00);
			$table->decimal('total_igv', 12, 2)->default(0);
            $table->decimal('total_value', 12, 2)->default(0);
			$table->decimal('precio_unitario', 12, 5);
            $table->decimal('total', 12, 2);
			$table->integer('estado')->default(1);
			$table->foreignId('medida_id')->nullable()->constrained('medidas');
			$table->foreignId('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreignId('articulo_id')->references('id')->on('articulos');
		});
    }
	
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::dropIfExists('detalle_venta');
    }
};
