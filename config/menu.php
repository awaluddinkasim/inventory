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
        'route-active' => 'master',
        'label' => 'Master Data',
        'icon' => 'bx-layout',
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
        ],
        'admin-only' => false,
    ],
    [
        'route-active' => 'grips',
        'label' => 'Data Grip',
        'icon' => 'bx-dock-top',
        'route-name' => 'grips',
        'admin-only' => false,
    ],
    [
        'route-active' => 'stock',
        'label' => 'Stock',
        'icon' => 'bx-collection',
        'route-name' => 'stock',
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
        'route-active' => 'users',
        'label' => 'Users',
        'icon' => 'bx-user',
        'route-name' => 'users',
        'admin-only' => true,
    ],
];
