<?php

return [
    'name' => 'Qatar 2022 Predictor',
    'manifest' => [
        'name' => 'Qatar 2022 Predictor',
        'short_name' => 'Qatar 2022',
        'start_url' => 'https://qatar2022.kram.xyz/',
        'background_color' => '#953044',
        'theme_color' => '#953044',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '48x48' => [
                'path' => '/images/icons/maskable_icon_x48.png',
                'purpose' => 'maskable'
            ],
            '72x72' => [
                'path' => '/images/icons/maskable_icon_x72.png',
                'purpose' => 'maskable'
            ],
            '96x96' => [
                'path' => '/images/icons/maskable_icon_x96.png',
                'purpose' => 'maskable'
            ],
            '128x128' => [
                'path' => '/images/icons/maskable_icon_x128.png',
                'purpose' => 'maskable'
            ],
            '192x192' => [
                'path' => '/images/icons/maskable_icon_x192.png',
                'purpose' => 'maskable'
            ],
            '384x384' => [
                'path' => '/images/icons/maskable_icon_x384.png',
                'purpose' => 'maskable'
            ],
            '512x512' => [
                'path' => '/images/icons/maskable_icon_x512.png',
                'purpose' => 'maskable'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/apple-splash-640-1136.png',
            '750x1334' => '/images/icons/apple-splash-750-1334.png',
            '828x1792' => '/images/icons/apple-splash-828-1792.png',
            '1125x2436' => '/images/icons/apple-splash-1125-2436.png',
            '1242x2208' => '/images/icons/apple-splash-1242-2208.png',
            '1242x2688' => '/images/icons/apple-splash-1242-2688.png',
            '1536x2048' => '/images/icons/apple-splash-1536-2048.png',
            '1668x2224' => '/images/icons/apple-splash-1668-2224.png',
            '1668x2388' => '/images/icons/apple-splash-1668-2388.png',
            '2048x2732' => '/images/icons/apple-splash-2048-2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Fixtures',
                'description' => 'List of Fixtures',
                'url' => '/fixtures',
                'icons' => [
                    "src" => "/images/icons/icon-96x96.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Predictions',
                'description' => 'List of Predictions',
                'url' => '/predictions'
            ],
            [
                'name' => 'Leaderboard',
                'description' => 'See where you stand',
                'url' => '/leaderboard'
            ],
        ],
        'custom' => []
    ]
];
