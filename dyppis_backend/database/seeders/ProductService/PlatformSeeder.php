<?php

namespace Database\Seeders\ProductService;

use App\Models\MediaService\Mediafile;
use App\Models\ProductService\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{

    private static $mediafiles = [
        [
            'id' => '01e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'microsoft-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '02e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'google-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '03e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'steam-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '04e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'epic-games-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '05e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'origin-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '06e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'adobe-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '07e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'microsoft-office-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '08e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'uplay-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '09e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'youtube-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '10e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'jetbrains-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '11e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'adobe-photoshop-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '12e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'adobe-after-effects-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
        [
            'id' => '13e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'file_name' => 'adobe-animate-logo.svg',
            'file_type' => 'image/svg',
            'file_size' => 4196,
            'category_id' => '05b44947-463f-4643-8bfa-a2c8b926e965'
        ],
    ];


    private static $items = [
        [
            'id' => '01e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'microsoft',
            'title' => 'Microsoft',
            'logo_id' => '01e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '02e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'google',
            'title' => 'Google',
            'logo_id' => '02e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '03e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'steam',
            'title' => 'Steam',
            'logo_id' => '03e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '1cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '04e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'epic-games',
            'title' => 'Epic Games',
            'logo_id' => '04e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '1cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '05e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'origin',
            'title' => 'Origin',
            'logo_id' => '05e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '1cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '06e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'adobe',
            'title' => 'Adobe',
            'logo_id' => '06e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '07e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'microsoft-office',
            'title' => 'Microsoft Office',
            'logo_id' => '07e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => '01e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd'
        ],
        [
            'id' => '08e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'uplay',
            'title' => 'Uplay',
            'logo_id' => '08e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '1cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '09e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'youtube',
            'title' => 'Youtube',
            'logo_id' => '09e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '3cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => '02e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd'
        ],
        [
            'id' => '10e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'jetbrains',
            'title' => 'Jetbrains',
            'logo_id' => '10e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => null
        ],
        [
            'id' => '11e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'adobe-photoshop',
            'title' => 'Adobe Photoshop',
            'logo_id' => '11e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => '06e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd'
        ],
        [
            'id' => '12e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'adobe-after-effects',
            'title' => 'Adobe After Effects',
            'logo_id' => '12e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => '06e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd'
        ],
        [
            'id' => '13e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'slug' => 'adobe-animate',
            'title' => 'Adobe Animate',
            'logo_id' => '13e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'category_id' => '2cc61c85-c228-38ac-b10d-b8af50f551a2',
            'parent_id' => '06e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd'
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Mediafile::insert(self::$mediafiles);
        Platform::insert(self::$items);
    }
}
