<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Categorias::factory()->count(5)->create();
        Productos::factory()->count(20)->create();
    }
}
