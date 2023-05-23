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
		if (!Schema::hasTable('persons')) {
			Schema::create('persons', function (Blueprint $table) {
				$table->id();
				$table->string('identity_document_id', 2);
				$table->string('name');
				$table->string('razon_name');
				$table->string('document')->nullable();
				$table->string('email')->nullable();
				$table->integer('phone')->nullable();
				$table->string('address')->nullable();
				$table->char('country_id', 2)->nullable();
				$table->char('department_id', 2)->nullable();
				$table->char('province_id', 4)->nullable();
				$table->char('district_id', 6)->nullable();
				$table->tinyInteger('estado')->default(1)->nullable();
				$table->timestamps();
				$table->foreign('identity_document_id')->references('id')->on('identity_documents');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('persons');
	}
};
