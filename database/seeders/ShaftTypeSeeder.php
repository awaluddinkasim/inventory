<?php

namespace Database\Seeders;

use App\Models\ShaftType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShaftTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['brand' => 'Graphite Design', 'name' => 'Tour AD VF'],
            ['brand' => 'Graphite Design', 'name' => 'Tour AD CQ'],
            ['brand' => 'Graphite Design', 'name' => 'Tour AD UB'],
            ['brand' => 'Graphite Design', 'name' => 'Anti Gravity'],
        ];

        ShaftType::insert($types);
    }
}
