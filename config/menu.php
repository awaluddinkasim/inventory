<?php

return [
    [
        'route-active' => 'dashboard',
        'label' => 'Dashboard',
        'icon' => 'bx-home-circle',
        'route-name' => 'dashboard',
        'admin-only' => false,
    ],
    [
        'route-active' => 'grips',
        'label' => 'Grips',
        'icon' => 'bx-archive',
        'submenu' => [
            [
                'route-active' => 'type',
                'label' => 'Type',
                'route-name' => 'master.type',
            ],
            [
                'route-active' => 'model',
                'label' => 'Model',
                'route-name' => 'master.model',
            ],
            [
                'route-active' => 'grips',
                'label' => 'Data',
                'route-name' => 'grips',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'shafts',
        'label' => 'Shaft',
        'icon' => 'bx-archive',
        'submenu' => [
            [
                'route-active' => 'type',
                'label' => 'Type',
                // 'route-name' => 'master.type',
            ],
            [
                'route-active' => 'grips',
                'label' => 'Data',
                // 'route-name' => 'grips',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'clubhead',
        'label' => 'Clubhead',
        'icon' => 'bx-archive',
        'submenu' => [
            [
                'route-active' => 'type',
                'label' => 'Type',
                // 'route-name' => 'master.type',
            ],
            [
                'route-active' => 'grips',
                'label' => 'Data',
                // 'route-name' => 'grips',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'stock-in',
        'label' => 'Stock In',
        'icon' => 'bx-archive-in',
        // 'route-name' => 'stock',
        'admin-only' => false,
    ],
    [
        'route-active' => 'stock-out',
        'label' => 'Stock Out',
        'icon' => 'bx-archive-out',
        // 'route-name' => 'stock',
        'admin-only' => false,
    ],
    [
        'route-active' => 'barcode',
        'label' => 'Barcode',
        'icon' => 'bx-barcode',
        'route-name' => 'barcode',
        'admin-only' => false,
    ],
    [
        'route-active' => 'report',
        'label' => 'Report',
        'icon' => 'bx-chart',
        // 'route-name' => 'report',
        'admin-only' => false,
    ],
    [
        'route-active' => 'users',
        'label' => 'Users',
        'icon' => 'bx-user',
        'submenu' => [
            [
                'route-active' => 'type',
                'label' => 'Admin',
                // 'route-name' => 'master.type',
            ],
            [
                'route-active' => 'model',
                'label' => 'Member',
                // 'route-name' => 'master.model',
            ],
        ],
        'admin-only' => false,
    ],
];
