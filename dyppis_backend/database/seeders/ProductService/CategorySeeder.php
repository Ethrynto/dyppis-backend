<?php

namespace Database\Seeders\ProductService;

use App\Models\ProductService\Category;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    private static $translations = [
        [
            'id' => '01f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'الحساب',
            'de' => 'Konto',
            'fr' => 'Compte',
            'en' => 'Account',
            'es' => 'Cuenta',
            'it' => 'Conto',
            'tr' => 'Hesap',
            'ru' => 'Аккаунт',
        ],
        [
            'id' => '02f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'مفتاح الترخيص',
            'de' => 'Lizenzschlüssel',
            'fr' => 'Clé de licence',
            'en' => 'License key',
            'es' => 'Clave de licencia',
            'it' => 'Chiave di licenza',
            'tr' => 'Lisans anahtarı',
            'ru' => 'Лицензионный ключ',
        ],
        [
            'id' => '03f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'الهدايا',
            'de' => 'Geschenk',
            'fr' => 'Cadeau',
            'en' => 'Gift',
            'es' => 'Regalo',
            'it' => 'Regalo',
            'tr' => 'Hediye',
            'ru' => 'Подарок',
        ],
        [
            'id' => '04f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'البند',
            'de' => 'Artikel',
            'fr' => 'Objet',
            'en' => 'Item',
            'es' => 'Artículo',
            'it' => 'Articolo',
            'tr' => 'Öğe',
            'ru' => 'Предмет',
        ],
        [
            'id' => '05f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'الخدمة',
            'de' => 'Dienst',
            'fr' => 'Service',
            'en' => 'Service',
            'es' => 'Servicio',
            'it' => 'Servizio',
            'tr' => 'Hizmet',
            'ru' => 'Услуга',
        ],
        [
            'id' => '06f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'عملة اللعبة',
            'de' => 'Spielwährung',
            'fr' => 'Monnaie du jeu',
            'en' => 'Game currency',
            'es' => 'Moneda del juego',
            'it' => 'Valuta del gioco',
            'tr' => 'Oyun para birimi',
            'ru' => 'Игровая валюта',
        ],
        [
            'id' => '07f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'الإيجار',
            'de' => 'Miete',
            'fr' => 'Loyer',
            'en' => 'Rent',
            'es' => 'Alquiler',
            'it' => 'Affitto',
            'tr' => 'Kiralık',
            'ru' => 'Аренда',
        ],
        [
            'id' => '08f10c29-2a59-443d-a805-6afb416bdc9e',
            'ar' => 'التصميم',
            'de' => 'Gestaltung',
            'fr' => 'Conception',
            'en' => 'Design',
            'es' => 'Diseño',
            'it' => 'Design',
            'tr' => 'Tasarım',
            'ru' => 'Дизайн',
        ],
    ];

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
            'title_id' => '01f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '02ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'license-key',
            'title_id' => '02f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '03ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'gift',
            'title_id' => '03f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '04ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'item',
            'title_id' => '04f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '05ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'service',
            'title_id' => '05f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '06ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'game-currency',
            'title_id' => '06f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '07ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'rent',
            'title_id' => '07f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
        [
            'id' => '08ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'slug' => 'design',
            'title_id' => '08f10c29-2a59-443d-a805-6afb416bdc9e',
            'is_public' => true,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Translation::insert(self::$translations);
        Category::insert(self::$items);
    }
}
