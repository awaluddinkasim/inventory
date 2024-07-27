<?php

namespace Database\Seeders;

use App\Models\GripType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['mfg' => 'Golf Pride', 'name' => 'Align Technology'],
            ['mfg' => 'Golf Pride', 'name' => 'Hybrid'],
            ['mfg' => 'Golf Pride', 'name' => 'Cord'],
            ['mfg' => 'Golf Pride', 'name' => 'All Rubber'],
            ['mfg' => 'Golf Pride', 'name' => 'Putter'],
        ];

        GripType::insert($types);
    }
}
