<?php

namespace Database\Seeders\ProductService;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\ProductService\Product::all()->pluck('id')->toArray();
        $users = \App\Models\UserService\User::all()->pluck('id')->toArray();

        for ($i = 0; $i < count($products); $i++) {
            DB::table('products_users')->insert([
                'product_id' => $products[$i],
                'user_id' => $users[$i]]
            );
        }
    }
}
