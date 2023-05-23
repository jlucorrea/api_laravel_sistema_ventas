<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('caja_movimientos', function (Blueprint $table) {
            $table->id();
			$table->string('motivo')->nullable();
            $table->foreignId('caja_id')->nullable()->constrained('cajas');
            $table->decimal('monto',8,2)->default(0);
            $table->integer('tipo')->default(1);
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_movimientos');
    }
};
