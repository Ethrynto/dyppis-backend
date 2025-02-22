<?php

namespace Database\Seeders\UserService;

use App\Models\UserService\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    /**
     *  User template for filling
     */
    private static $template = [
        'nickname'      => 'user1',
        'email'         => 'user1@example.com',
        'password'      => 'password',
        'register_ip'   => '127.0.0.1',
        'seo_source'    => 'beta'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++)
        {
            $item = [
                'nickname'      => 'user' . $i,
                'email'         => 'user' . $i . '@example.com',
                'password'      => Hash::make('password'),
                'register_ip'   => '127.0.0.1',
                'seo_source'    => 'beta'
            ];
            User::insert($item);
        }
    }
}
