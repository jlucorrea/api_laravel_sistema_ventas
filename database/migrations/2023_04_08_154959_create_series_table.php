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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
			$table->integer('sucursal_id')->nullable();
			$table->string('serie')->nullable();
			$table->string('number')->nullable();
            $table->foreignId('comprobante_id')->nullable()->constrained('comprobantes');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });	
		
		DB::table('series')->insert([
            ['sucursal_id' => 1, 'serie' => 'F001', 'number'=>1, 'comprobante_id' => 1, 'estado' => 1],
            ['sucursal_id' => 1, 'serie' => 'B001', 'number'=>1, 'comprobante_id' => 2, 'estado' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
