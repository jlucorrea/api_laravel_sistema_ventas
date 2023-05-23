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
		if (!Schema::hasTable('identity_documents')) {
			Schema::create('identity_documents', function (Blueprint $table) {
				$table->string('id', 2)->index();
				$table->boolean('active');
				$table->string('description');
			});
		}

		DB::table('identity_documents')->insert([
			['id' => '0', 'active' => false, 'description' => 'Sin Documento'],
			['id' => '1', 'active' => true, 'description' => 'DNI'],
			['id' => '6', 'active' => true, 'description' => 'RUC']
		]);
		
		if (!Schema::hasTable('currency_types')) {
            Schema::create('currency_types', function (Blueprint $table) {
                $table->string('id', 4)->index();
                $table->boolean('active');
                $table->string('symbol')->nullable();
                $table->string('description');
            });
        }

        DB::table('currency_types')->insert([
            ['id' => 'PEN', 'active' => true, 'symbol' => 'S/', 'description' => 'Soles'],
            ['id' => 'USD', 'active' => true, 'symbol' => '$', 'description' => 'Dólares Americanos'],
        ]);
    }
	
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_document');
		Schema::dropIfExists('currency_types');
    }
};
