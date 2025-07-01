<?php

namespace Database\Seeders\ProductService;

use App\Models\MediaService\Mediafile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoryId = '06b44947-463f-4643-8bfa-a2c8b926e965';
        $mediafiles = [
            [
                'id' => '1aa673a1-63a5-3784-b170-1f0425ed7b28',
                'file_name' => 'forza-horizon-5.jpeg',
                'file_type' => 'image/jpeg',
                'file_size' => 204800,
                'category_id' => $categoryId,
            ],
            [
                'id' => '2aa673a1-63a5-3784-b170-1f0425ed7b28',
                'file_name' => 'gta-5.jpg',
                'file_type' => 'image/jpg',
                'file_size' => 204800,
                'category_id' => $categoryId,
            ],
            [
                'id' => '3aa673a1-63a5-3784-b170-1f0425ed7b28',
                'file_name' => 'cs-2.jpeg',
                'file_type' => 'image/jpeg',
                'file_size' => 204800,
                'category_id' => $categoryId,
            ],
        ];

        Mediafile::insert($mediafiles);
        $products = \App\Models\ProductService\Product::all()->pluck('id')->toArray();
        for ($i = 0; $i < count($products); $i++) {
            DB::table('products_images')->insert([
                [
                    'product_id' => $products[$i],
                    'mediafile_id' => $mediafiles[0]['id'],
                ],
                [
                    'product_id' => $products[$i],
                    'mediafile_id' => $mediafiles[1]['id'],
                ],
                [
                    'product_id' => $products[$i],
                    'mediafile_id' => $mediafiles[2]['id'],
                ]
            ]);
        }
    }
}
