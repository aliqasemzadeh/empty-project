<?php
return [
    'general' => [
        'title' => 'تنظیمات عمومی',
        'description' => 'در این قسمت تنظیمات عمومی سایت وجود دارد.',
        'options' => [
            'name' => [
                'group' => 'general',
                'name' => 'general_name',
                'value' => 'نام سایت من',
                'type' => 'string',
            ],
            'name_description' => '',
        ],
    ],
    'maintenance' => [
        'title' => 'تنظیمات عمومی',
        'description' => 'در این قسمت تنظیمات عمومی سایت وجود دارد.',
        'options' => [
            'name' => [
                'group' => 'maintenance',
                'name' => 'maintenance_mode',
                'value' => false,
                'type' => 'boolean',
            ],
            'name_description' => '',
        ],
    ],
];
