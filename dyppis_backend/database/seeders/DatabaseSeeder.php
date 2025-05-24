<?php

namespace Database\Seeders;

use App\Models\UserService\User;
use Database\Seeders\MediaService\MediafileCategorySeeder;
use Database\Seeders\ProductService\CategorySeeder;
use Database\Seeders\ProductService\DeliverySeeder;
use Database\Seeders\ProductService\PlatformCategorySeeder;
use Database\Seeders\ProductService\PlatformSeeder;
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
        $this->call(PlatformCategorySeeder::class);
        $this->call(PlatformSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DeliverySeeder::class);
        User::factory(50)->create();
    }
}
