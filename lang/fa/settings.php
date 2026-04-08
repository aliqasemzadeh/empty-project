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
                'translate' => 'نام سایت',
                'meta' => [],
                'default' => 'نام سایت من',
            ],
            'description' => [
                'group' => 'general',
                'name' => 'general_description',
                'value' => 'توضیحات سایت',
                'type' => 'text',
                'translate' => 'توضیحات سایت',
                'meta' => [],
                'default' => 'توضیحات سایت',
            ],
        ],
    ],
    'maintenance' => [
        'title' => 'وضعیت سایت',
        'description' => 'در این قسمت شما می توانید وضعیت سایت را که آنلاین یا آفلاین است را مشخص کنید.',
        'options' => [
            'mode' => [
                'group' => 'maintenance',
                'name' => 'maintenance_mode',
                'value' => false,
                'type' => 'boolean',
                'translate' => 'وضعیت سایت',
                'meta' => [],
                'default' => false,
            ],
            'message' => [
                'group' => 'maintenance',
                'name' => 'maintenance_message',
                'value' => '',
                'type' => 'text',
                'translate' => 'پیام وضعیت سایت',
                'meta' => [],
                'default' => '',
            ],
        ],
    ],
];
