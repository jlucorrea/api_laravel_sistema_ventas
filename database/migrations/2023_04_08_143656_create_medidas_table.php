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
        Schema::create('medidas', function (Blueprint $table) {
            $table->id();
			$table->string('codigo')->nullable();
			$table->string('nombre')->nullable();
			$table->boolean('estado')->default(1);
            $table->timestamps();
        });

		DB::table('medidas')->insert([
            ['codigo' => 'ZZ', 'nombre' => 'SERVICIO', 'estado' => true],
            ['codigo' => 'NIU', 'nombre' => 'UNIDADES', 'estado' => true],
			['codigo' => 'DZN', 'nombre' => 'DOCENA', 'estado' => true],
			['codigo' => 'BX', 'nombre' => 'CAJA', 'estado' => true],
            ['codigo' => 'PK', 'nombre' => 'PAQUETE', 'estado' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medidas');
    }
};
