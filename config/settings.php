<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings Path
    |--------------------------------------------------------------------------
    |
    | This is where your settings are stored on disk within your application's
    | `storage` directory. Note: any subdirectories must already exist.
    |
    | Defaults to 'app/settings.json' if not specified here.
    |
    */

    'path' => 'app/settings.json',

    /*
    |--------------------------------------------------------------------------
    | Navigation Title
    |--------------------------------------------------------------------------
    |
    | This is the text Nova's navigation sidebar will display for this tool.
    |
    | Defaults to 'Settings' if not specified here.
    |
    */

    'navigation' => 'Settings',

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | This is the good stuff :). Each 'panel' will be shown grouped together
    | under its 'title'. Each 'setting' in a panel will display a row in Nova,
    | and you can specify the key used to store its value on disk, its display
    | name in Nova, a description, its type (only boolean or text for now),
    | and a link for more information.
    |
    | Each setting must include at least a key, name, and type.
    |
    */

    'panels' => [

        [
            'name' => 'Contact Us',
            'settings' => [
                [
                    'key'         => 'wechat',
                    'name'        => 'WeChat',
                    'type'        => 'text',
                    'description' => "Company's WeChat number.",
                ],

                [
                    'key'         => 'email',
                    'name'        => 'Email',
                    'type'        => 'text',
                    'description' => "Company's email support address.",
                ],

                [
                    'key'         => 'office_name',
                    'name'        => 'Office name',
                    'type'        => 'text',
                    'description' => "Main office's name (displayed under 'help' section)",
                ],

                [
                    'key'         => 'office_address',
                    'name'        => 'Office address',
                    'type'        => 'textarea',
                    'description' => "Main office's address (displayed under 'help' section)",
                ],

                [
                    'key'         => 'office_number',
                    'name'        => 'Office number',
                    'type'        => 'text',
                    'description' => "Main office's contact number (displayed under 'help' section)",
                ],
            ],
        ],
        [
            'name' => 'Bank details',
            'settings' => [
                [
                    'key'         => 'bank_name',
                    'name'        => 'Bank Name',
                    'type'        => 'text',
                    'description' => "Name of the bank the customers will need to transfer to.",
                ],

                [
                    'key'         => 'bank_account',
                    'name'        => 'Bank Account',
                    'type'        => 'text',
                    'description' => "Account number of the bank the customers will need to transfer to.",
                ],
            ]
        ]
    ],

];
