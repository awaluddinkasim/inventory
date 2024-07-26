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
                'label' => 'Type',
                'route-name' => 'master.type',
            ],
            [
                'label' => 'Model',
                'route-name' => 'master.model',
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
        'route-name' => 'stock',
        'admin-only' => false,
    ],
    [
        'label' => 'Barcode',
        'icon' => 'bx-barcode',
        'route-name' => 'barcode',
        'admin-only' => false,
    ],
    [
        'label' => 'Users',
        'icon' => 'bx-user',
        'route-name' => 'users',
        'admin-only' => true,
    ],
];
