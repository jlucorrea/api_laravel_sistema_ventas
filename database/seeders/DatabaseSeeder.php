<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nombre' => 'Jorge Correa',
            'email' => 'admin@admin.com',
			'password' => Hash::make('password'),
        ]);

		\App\Models\Person::create([
			'identity_document_id' => 1,
			'name' => 'PUBLICO GENERAL',
			'razon_name' => 'PUBLICO GENERAL',
			'document' => 00000000,
			'estado' => 1
        ]);
		
		\App\Models\Sucursal::create([
			'nombre' => 'SUCURSAL PRINCIPAL',
			'direccion' => 'CALLE PRINCIPAL 53',
			'telefono' => 5595959,
			'estado' => 1
        ]);
    }
}
