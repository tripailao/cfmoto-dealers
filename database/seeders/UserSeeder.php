<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Matias',
            'lastname' => 'Tripailao',
            'email' => 'm@t.cl',
            'password' => bcrypt('demo1234'),
            'dealer_id' => '1',
        ])->assignRole('super-admin');

        User::factory()->create([
            'name' => 'Fernando',
            'lastname' => 'Arroyo',
            'email' => 'fernando@cfmotochile.cl',
            'password' => bcrypt('demo1234'),
            'dealer_id' => '1',
        ])->assignRole('super-admin');

        User::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'j@doe.com',
            'password' => bcrypt('demo1234'),
            'dealer_id' => '3',
        ])->assignRole('dealer');

    }
}
