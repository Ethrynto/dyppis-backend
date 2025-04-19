<?php

namespace Database\Seeders\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\ProductService\PlatformCategory;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformCategorySeeder extends Seeder
{
    private static $translations = [
        [
            'id' => '1f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'ar' => 'الألعاب',
            'de' => 'Spiele',
            'fr' => 'Jeux',
            'en' => 'Games',
            'es' => 'Juegos',
            'it' => 'Giochi',
            'tr' => 'Oyunlar',
            'ru' => 'Игры',
        ],
        [
            'id' => '2f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'ar' => 'البرمجيات',
            'de' => 'Software',
            'fr' => 'Logiciel',
            'en' => 'Software',
            'es' => 'Software',
            'it' => 'Software',
            'tr' => 'Yazılım',
            'ru' => 'Программное обеспечение',
        ],
        [
            'id' => '3f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'ar' => 'الشبكات الاجتماعية والتطبيقات',
            'de' => 'Soziale Netzwerke und Apps',
            'fr' => 'Réseaux sociaux et apps',
            'en' => 'Social networks & Apps',
            'es' => 'Redes sociales y aplicaciones',
            'it' => 'Reti sociali e app',
            'tr' => 'Sosyal ağlar ve uygulamalar',
            'ru' => 'Соцсети и сервисы',
        ],
        [
            'id' => '4f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'ar' => 'ألعاب الهاتف المحمول',
            'de' => 'Mobile Spiele',
            'fr' => 'Jeux mobiles',
            'en' => 'Mobile games',
            'es' => 'Juegos para móviles',
            'it' => 'Giochi per cellulari',
            'tr' => 'Mobil oyunlar',
            'ru' => 'Мобильные игры',
        ]
    ];

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
            'title_id' => '1f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'logo_id' => '1e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'software',
            'title_id' => '2f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'logo_id' => '2e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '3cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'apps',
            'title_id' => '3f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'logo_id' => '3e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ],
        [
            'id' => '4cc61c85-c228-38ac-b10d-b8af50f551a2',
            'slug' => 'mobile-games',
            'title_id' => '4f27d3a7-f605-3412-80bd-7f1fc7a66aca',
            'logo_id' => '4e229ceb-ba4b-4017-a7e1-88ffccd3295a'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Translation::insert(self::$translations);
//        foreach (self::$mediafiles as $file) {
//            Mediafile::insert($file);
//        }
        Mediafile::insert(self::$mediafiles);
        PlatformCategory::insert(self::$items);
    }
}
