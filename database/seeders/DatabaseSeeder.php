<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prize;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Prize::truncate();
        Prize::insert([
            ['name' => 'Gold Coin', 'quantity' => 10, 'probability' => 10.0],
            ['name' => 'Silver Coin', 'quantity' => 20, 'probability' => 20.0],
            ['name' => 'Bronze Coin', 'quantity' => 30, 'probability' => 30.0],
        ]);
    }
}
