<?php

namespace Database\Seeders;

use App\Models\GripModel;
use App\Models\GripType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GripModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = GripType::all();

        $models = [
            'Align Technology' => [
                'MCC Plus4 ALIGN',
                'MCC ALIGN',
                'Tour Velvet ALIGN',
                'ZGRIP ALIGN',
            ],
            'Hybrid' => [
                'MCC Plus4',
                'MCC',
                'ZGRIP',
            ],
            'Cord' => [
                'Tour Velvet Cord'
            ],
            'All Rubber' => [
                'CP2 Pro',
                'CP2 Wrap', 'CPX',
                'Tour Velvet',
                'Tour Velvet Plus4',
                'Tour Velvet 360',
                'Tour Velvet 60 R',
                'Tour Wrap',
            ],
            'Putter' => [
                'Reverse Taper - Flat',
                'Reverse Taper - Pistol',
                'Reverse Taper - Round',
            ],
        ];

        foreach ($types as $type) {
            if (isset($models[$type->name])) {
                foreach ($models[$type->name] as $modelName) {
                    GripModel::insert([
                        'type_id' => $type->id,
                        'name' => $modelName,
                    ]);
                }
            }
        }
    }
}
