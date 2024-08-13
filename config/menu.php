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
        'label' => 'Grip',
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
            [
                'route-active' => 'barcode',
                'label' => 'Barcode',
                // 'route-name' => '#',
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
                'route-active' => 'types',
                'label' => 'Type',
                'route-name' => 'shaft.type',
            ],
            [
                'route-active' => 'items',
                'label' => 'Item',
                'route-name' => 'shaft.items',
            ],
            [
                'route-active' => 'barcode',
                'label' => 'Barcode',
                // 'route-name' => '#',
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
                // 'route-name' => '#',
            ],
            [
                'route-active' => 'grips',
                'label' => 'Data',
                // 'route-name' => '#',
            ],
            [
                'route-active' => 'barcode',
                'label' => 'Barcode',
                // 'route-name' => '#',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'purchases',
        'label' => 'Purchase',
        'icon' => 'bx-archive-in',
        'submenu' => [
            [
                'route-active' => 'grip',
                'label' => 'Grip',
                'route-name' => 'purchase.grip',
            ],
            [
                'route-active' => 'shaft',
                'label' => 'Shaft',
                'route-name' => 'purchase.shaft',
            ],
            [
                'route-active' => 'club-head',
                'label' => 'Club Head',
                // 'route-name' => '#',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'stock-out',
        'label' => 'Sales',
        'icon' => 'bx-archive-out',
        'submenu' => [
            [
                'route-active' => 'grip',
                'label' => 'Grip',
                // 'route-name' => '#',
            ],
            [
                'route-active' => 'shaft',
                'label' => 'Shaft',
                // 'route-name' => '#',
            ],
            [
                'route-active' => 'club-head',
                'label' => 'Club Head',
                // 'route-name' => '#',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'report',
        'label' => 'Report',
        'icon' => 'bx-chart',
        // 'route-name' => '#',
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
