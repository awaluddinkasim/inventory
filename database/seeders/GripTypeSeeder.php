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
            ['brand' => 'Golf Pride', 'name' => 'Align Technology'],
            ['brand' => 'Golf Pride', 'name' => 'Hybrid'],
            ['brand' => 'Golf Pride', 'name' => 'Cord'],
            ['brand' => 'Golf Pride', 'name' => 'All Rubber'],
            ['brand' => 'Golf Pride', 'name' => 'Putter'],
        ];

        GripType::insert($types);
    }
}
