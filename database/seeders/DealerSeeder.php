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
            'name' => 'Motomania',
            'city' => 'Santiago Centro',
            'address' => 'San Diego 180',
            'phone' => '2224567',
        ]);

        Dealer::factory(7)->create();
    }
}
