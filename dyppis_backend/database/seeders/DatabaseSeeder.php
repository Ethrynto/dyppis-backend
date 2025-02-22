<?php

namespace Database\Seeders;

use App\Models\UserService\User;
use Database\Seeders\CurrencyService\CurrencySeeder;
use Database\Seeders\MediaService\MediafileCategorySeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MediafileCategorySeeder::class);
        $this->call(CurrencySeeder::class);
        User::factory(50)->create();
    }
}
