<?php

return [
    // 'default' => env('OMS_NOTIFICATION_ENV', 'production'),

    'production' => [
        'host' => env('OMS_NOTIFICATION_PRODUCTION_HOST', NULL),
    ],
    
    'test' => [
        'host' => env('OMS_NOTIFICATION_TEST_HOST', NULL),
    ],
    
    'homolog' => [
        'host' => env('OMS_NOTIFICATION_HOMOLOG_HOST', NULL),
    ],
    
    'development' => [
        'host' => env('OMS_NOTIFICATION_DEV_HOST', NULL),
    ],
];
