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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->nullable()->constrained('users');
			$table->foreignId('sucursal_id')->nullable()->constrained('sucursals');
			$table->unsignedBigInteger('document_type_id')->nullable();
			$table->char('series', 4)->nullable();
            $table->integer('number')->nullable();
			$table->foreignId('customer_id')->nullable()->constrained('persons');
			$table->json('customer')->nullable();
            $table->string('currency_type_id', 4)->nullable();
			$table->smallInteger('status_paid')->default(1);
			$table->integer('dias_credito')->default(1);
			$table->decimal('total_igv', 12, 2)->default(0);
            $table->decimal('total_value', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
