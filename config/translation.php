<?php

return [

    'driver' => 'file',

    'route_group_config' => [
        'middleware' => ['web', 'auth:sanctum'],
    ],

    'translation_methods' => ['trans', '__', '@lang'],

    'scan_paths' => [app_path(), resource_path()],

    'ui_url' => 'admin/dil',

    'database' => [

        'connection' => '',

        'languages_table' => 'languages',

        'translations_table' => 'translations',
    ],
];
