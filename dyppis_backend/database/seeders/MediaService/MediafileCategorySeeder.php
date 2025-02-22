<?php

namespace Database\Seeders\MediaService;

use App\Models\MediaService\MediafileCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediafileCategorySeeder extends Seeder
{
    private static $items = [
        [
            'id' => '01b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'avatar',
            'title' => 'Avatar icons',
            'path' => '/uploads/images/avatars',
            'url' => '/storage/uploads/images/avatars',
        ],
        [
            'id' => '02b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'banner',
            'title' => 'Banner pictures',
            'path' => '/uploads/images/banners',
            'url' => '/storage/uploads/images/banners',
        ],
        [
            'id' => '03b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'flag',
            'title' => 'Flag icons',
            'path' => '/uploads/images/flags',
            'url' => '/storage/uploads/images/flags',
        ],
        [
            'id' => '04b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'icon',
            'title' => 'UI element icons',
            'path' => '/uploads/images/icons',
            'url' => '/storage/uploads/images/icons',
        ],
        [
            'id' => '05b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'platform',
            'title' => 'Platform icons',
            'path' => '/uploads/images/platforms',
            'url' => '/storage/uploads/images/platforms',
        ],
        [
            'id' => '06b44947-463f-4643-8bfa-a2c8b926e965',
            'slug' => 'product',
            'title' => 'Product pictures',
            'path' => '/uploads/images/products',
            'url' => '/storage/uploads/images/products',
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediafileCategory::insert(self::$items);
    }
}
