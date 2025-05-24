<?php

namespace Database\Seeders\ProductService;

use App\Models\ProductService\Delivery;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    private static $items = [
        [
            'id' => '01e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'slug' => 'full-access',
            'title' => 'Полный доступ',
            'description' => 'Полный доступ предоставляет неограниченное использование всех функций и сервисов.',
            'logo_id' => null,
        ],
        [
            'id' => '02e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'slug' => 'part-access',
            'title' => 'Частичный доступ',
            'description' => 'Частичный доступ позволяет использовать только определённые функции с некоторыми ограничениями.',
            'logo_id' => null,
        ],
        [
            'id' => '03e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'slug' => 'rebind',
            'title' => 'Перепревязка',
            'description' => 'Перепревязка позволяет изменять или обновлять данные связанного аккаунта для обеспечения безопасности.',
            'logo_id' => null,
        ],
        [
            'id' => '04e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'slug' => 'rent',
            'title' => 'Аренда',
            'description' => 'Аренда позволяет временно использовать аккаунт или сервис в течение определённого периода.',
            'logo_id' => null,
        ],
        [
            'id' => '05e36ceb-ba4b-4017-a7e1-88ffccd3295a',
            'slug' => 'offline-account',
            'title' => 'Оффлайн аккаунт',
            'description' => 'Оффлайн аккаунт работает без подключения к интернету после первоначальной настройки.',
            'logo_id' => null,
        ],
        // Add more items as needed
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Delivery::insert(self::$items);
    }
}
