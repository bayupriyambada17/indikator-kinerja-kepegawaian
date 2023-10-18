<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rektor',
            'email' => 'rektor@pelitabangsa.com',
            'password' => Hash::make('password'),
            'roles' => 1 // rektor
        ]);
        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@pelitabangsa.com',
            'password' => Hash::make('password'),
            'roles' => 2 // operator
        ]);
        User::factory()->create([
            'name' => 'Fakultas',
            'email' => 'fakultas@pelitabangsa.com',
            'password' => Hash::make('password'),
            'roles' => 3 // fakultas
        ]);
    }
}
