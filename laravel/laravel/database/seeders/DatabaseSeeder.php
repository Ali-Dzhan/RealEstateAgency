<?php

namespace Database\Seeders;

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
       $this->call([
           UserSeeder::class,
           AgentSeeder::class,
           ClientSeeder::class,
           RegionSeeder::class,
           PropertyTypeSeeder::class,
           PropertySeeder::class,
           ViewingSeeder::class,
           OfferSeeder::class,
       ]);
    }
}
