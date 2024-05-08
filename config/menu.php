<?php

return [
    'super-admin' => [
        [
            'text' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'home'
        ],

        [
            'text' => 'Master Data',
            'url' => '#',
            'title' => true
        ],
        [
            'text' => 'Data Staff',
            'icon' => 'users',
            'url' => '/staff',
        ],
        [
            'text' => 'Data Product',
            'icon' => 'archive',
            'url' => '/product',
        ],
        [
            'text' => 'Data Customer',
            'icon' => 'user-plus',
            'url' => '/customer',
        ],

        [
            'text' => 'Application',
            'url' => '#',
            'title' => true
        ],
        [
            'text' => 'Transaction',
            'icon' => 'activity',
            'url' => '/bill',
        ],

        [
            'text' => 'Report',
            'url' => '#',
            'title' => true
        ],
        [
            'text' => 'Transaction',
            'icon' => 'monitor',
            'url' => '/report/bill',
        ],
    ],
    'staff' => [
        [
            'text' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'home'
        ],
        [
            'text' => 'Master Data',
            'url' => '#',
            'icon' => 'home',
            'title' => true
        ],
        [
            'text' => 'Data Product',
            'icon' => 'archive',
            'url' => '/product',
        ],
        [
            'text' => 'Data Customer',
            'icon' => 'user-plus',
            'url' => '/customer',
        ],
        [
            'text' => 'Application',
            'url' => '#',
            'title' => true
        ],
        [
            'text' => 'Transaction',
            'icon' => 'activity',
            'url' => '/bill',
        ],

    ],
    'customer' => [
        [
            'text' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'home'
        ],
        [
            'text' => 'Application',
            'url' => '#',
            'icon' => 'home',
            'title' => true
        ],
        [
            'text' => 'Product',
            'url' => '/products',
            'icon' => 'archive'
        ],
        [
            'text' => 'Transaction',
            'icon' => 'activity',
            'url' => '/bill',
        ],
    ],
];
