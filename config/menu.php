<?php

return [
    [
        'label' => 'Dashboard',
        'icon' => 'bx-home-circle',
        'route-name' => 'dashboard',
        'admin-only' => false,
    ],
    [
        'label' => 'Master Data',
        'icon' => 'bx-layout',
        'submenu' => [
            [
                'label' => 'Model',
                'route-name' => 'master.model',
            ],
            [
                'label' => 'Size',
                'route-name' => 'master.size',
            ],
        ],
        'admin-only' => false,
    ],
    [
        'label' => 'Data Grip',
        'icon' => 'bx-dock-top',
        'route-name' => 'grips',
        'admin-only' => false,
    ],
    [
        'label' => 'Stock',
        'icon' => 'bx-collection',
        // 'route-name' => '#',
        'admin-only' => false,
    ],
    [
        'label' => 'Barcode',
        'icon' => 'bx-barcode',
        // 'route-name' => '#',
        'admin-only' => false,
    ],
    [
        'label' => 'Users',
        'icon' => 'bx-user',
        'route-name' => 'users',
        'admin-only' => true,
    ],
];
