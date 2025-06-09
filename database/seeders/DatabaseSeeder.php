<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dealer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DealerSeeder::class,
            SerieSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Matias',
            'lastname' => 'Tripailao',
            'email' => 'm@t.cl',
            'password' => bcrypt('demo1234'),
        ])->assignRole('super-admin');


    }
}
