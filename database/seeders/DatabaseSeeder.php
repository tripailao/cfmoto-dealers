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

        User::factory()->create([
            'name' => 'Matias',
            'email' => 'm@t.cl',
            'password' => bcrypt('demo1234'),
            'role' => 99,
        ]);
        User::factory()->create([

            'name' => 'John Doe',
            'email' => 'jdoe@gmail.com',
            'password' => bcrypt('demo1234'),

        ]);

        $this->call([
            DealerSeeder::class,
            SerieSeeder::class,
        ]);
    }
}
