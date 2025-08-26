<?php

return [
    'components' => [
        'wildberries' => [
            'class' => \wb\sdk\components\WildberriesComponent::class,
            'apiKey' => getenv('WB_API_KEY') ?: 'your-api-key-here',
        ],
    ],
    'params' => [
        'wbApiKey' => getenv('WB_API_KEY') ?: 'your-api-key-here',
    ],
];
