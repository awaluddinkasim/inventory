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
                'route-active' => 'types',
                'label' => 'Type',
                'route-name' => 'grip.type',
            ],
            [
                'route-active' => 'models',
                'label' => 'Model',
                'route-name' => 'grip.model',
            ],
            [
                'route-active' => 'items',
                'label' => 'Item',
                'route-name' => 'grip.items',
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
                'route-name' => 'shaft.type',
            ],
            [
                'route-active' => 'grips',
                'label' => 'Data',
                'route-name' => 'shaft.items',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'clubhead',
        'label' => 'Club Head',
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
                'route-active' => 'admins',
                'label' => 'Admin',
                'route-name' => 'user.admins',
            ],
            [
                'route-active' => 'members',
                'label' => 'Member',
                'route-name' => 'user.members',
            ],
        ],
        'admin-only' => true,
    ],
];
