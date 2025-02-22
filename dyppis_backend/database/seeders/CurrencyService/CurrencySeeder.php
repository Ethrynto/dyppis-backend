<?php

namespace Database\Seeders\CurrencyService;

use App\Models\CurrencyService\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    private static $items = [
        [
            'id' => '01b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'US Dollar',
            'code' => 'USD',
            'symbol' => '$',
        ],
        [
            'id' => '02b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'Euro',
            'code' => 'EUR',
            'symbol' => '€',
        ],
        [
            'id' => '03b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'British Pound',
            'code' => 'GBP',
            'symbol' => '£',
        ],
        [
            'id' => '04b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'Russian Ruble',
            'code' => 'RUB',
            'symbol' => '₽',
        ],
        [
            'id' => '05b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'Australian Dollar',
            'code' => 'AUD',
            'symbol' => 'A$',
        ],
        [
            'id' => '06b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'Canadian Dollar',
            'code' => 'CAD',
            'symbol' => 'C$',
        ],
        [
            'id' => '07b44947-463f-4643-8bfa-a2c8b926e965',
            'title' => 'Swiss Franc',
            'code' => 'CHF',
            'symbol' => '₣',
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::insert(self::$items);
    }
}
