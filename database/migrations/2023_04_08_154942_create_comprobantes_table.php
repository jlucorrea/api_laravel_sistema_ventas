<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
			$table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
        });

		DB::table('comprobantes')->insert([
            ['codigo' => '01', 'nombre' => 'FACTURA ELECTRÓNICA', 'estado' => true],
            ['codigo' => '03', 'nombre' => 'BOLETA DE VENTA ELECTRÓNICA', 'estado' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
