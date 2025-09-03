<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dealer;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dealers')->insert([
            'name' => 'CFMOTO Concepción',
            'city' => 'Talcahuano',
            'address' => 'Av. Jorge Alessandri 3763',
            'phone' => '99999999',
        ]);

        DB::table('dealers')->insert([
            'name' => 'CFMOTO Vitacura',
            'city' => 'Santiago',
            'address' => 'Avenida Vitacura 9096, Vitacura',
            'phone' => '+569 54194184',
        ]);

        DB::table('dealers')->insert([
            'name' => 'AGM Motos',
            'city' => 'Viña del Mar',
            'address' => 'Av Ojos del Salado 3115 Local N°3, Parque Industrial Curauma',
            'phone' => '+569 73101377',
        ]);

        //Dealer::factory(7)->create();
    }
}
