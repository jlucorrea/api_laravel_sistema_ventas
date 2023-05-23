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
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
			$table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('documento')->nullable();
            $table->string('impresora')->nullable();
			$table->string('codigo')->nullable();
            $table->string('impresora_url')->nullable();
            $table->integer('estado')->default(1);
			$table->char('country_id', 2)->nullable();
			$table->char('department_id', 2)->nullable();
			$table->char('province_id', 4)->nullable();
			$table->char('district_id', 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursals');
    }
};
