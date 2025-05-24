<?php

namespace Database\Seeders\ProductService;

use App\Models\ProductService\Category;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

//    private static $mediafiles = [
//        [
//            'id' => '01ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
//            'file_name' => 'games.svg',
//            'file_type' => 'image/svg',
//            'file_size' => 2048,
//            'category_id' => '04b44947-463f-4643-8bfa-a2c8b926e965'
//        ],
//    ];


    private static $items = [
        [
            'id' => '01ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'account',
            'title' => 'Аккаунт',
            'is_public' => true,
        ],
        [
            'id' => '02ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'license-key',
            'title' => 'Лицензионный ключ',
            'is_public' => true,
        ],
        [
            'id' => '03ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'gift',
            'title' => 'Подарок',
            'is_public' => true,
        ],
        [
            'id' => '04ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'item',
            'title' => 'Внутриигровой предмет',
            'is_public' => true,
        ],
        [
            'id' => '05ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'service',
            'title' => 'Услуга',
            'is_public' => true,
        ],
        [
            'id' => '06ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'game-currency',
            'title' => 'Игровая валюта',
            'is_public' => true,
        ],
        [
            'id' => '07ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'rent',
            'title' => 'Аренда',
            'is_public' => true,
        ],
        [
            'id' => '08ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'design',
            'title' => 'Дизайн',
            'is_public' => true,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(self::$items);
    }
}
