<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'nrp' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nrp' => 'user',
            'name' => 'user',
            'password' => Hash::make('user'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'nrp' => $faker->unique()->numberBetween(1000000000, 9999999999),
                'name' => $faker->name,
                'password' => Hash::make('user'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
