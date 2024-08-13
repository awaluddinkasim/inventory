<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@example',
            'password' => Hash::make('password'),
            'phone' => '0123456789',
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        $this->call([
            GripTypeSeeder::class,
            GripModelSeeder::class,
            ShaftTypeSeeder::class,
        ]);
    }
}
