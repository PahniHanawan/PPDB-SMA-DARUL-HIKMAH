<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'email' => 'hikmah@darul.com',
                'role' => 'admin',
                'password' => bcrypt('darulhikmah2025'),
            ]
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
