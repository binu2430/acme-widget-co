<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::create(['code' => 'R01', 'name' => 'Red Widget', 'price' => 32.95]);
        Product::create(['code' => 'G01', 'name' => 'Green Widget', 'price' => 24.95]);
        Product::create(['code' => 'B01', 'name' => 'Blue Widget', 'price' => 7.95]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
