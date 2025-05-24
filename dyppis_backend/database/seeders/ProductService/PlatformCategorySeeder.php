<?php

namespace Database\Seeders\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\ProductService\PlatformCategory;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformCategorySeeder extends Seeder
{
    private static $mediafiles = [
        [
            'id' => '1e229ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'games.svg',
            'file_type' => 'image/svg',
            'file_size' => 2048,
            'category_id' => '04b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '2e229ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'software.svg',
            'file_type' => 'image/svg',
            'file_size' => 2048,
            'category_id' => '04b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '3e229ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'apps.svg',
            'file_type' => 'image/svg',
            'file_size' => 2048,
            'category_id' => '04b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '4e229ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'mobile-games.svg',
            'file_type' => 'image/svg',
            'file_size' => 2048,
            'category_id' => '04b44947-463f-4643-8bfa-a2c8b926e965'
        ],
    ];

    private static $items = [
        [
            'id' => '1cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'games',
            'title' => 'Игры',
            'logo_id' => '1e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'software',
            'title' => 'Программное обеспечение',
            'logo_id' => '2e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '3cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'apps',
            'title' => 'Сервисы и соцсети',
            'logo_id' => '3e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '4cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'mobile-games',
            'title' => 'Мобильные игры',
            'logo_id' => '4e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mediafile::insert(self::$mediafiles);
        PlatformCategory::insert(self::$items);
    }
}
