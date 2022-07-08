<?php

return [
    'headers' => [
        'Content-Type' => 'text/xml',
    ],

    'declaration' => [
        'version' => env('XML_VERSION', '1.0'),
        'encoding' => env('XML_ENCODING', 'UTF-8'),
        // 'standalone' => env('XML_STANDALONE', 'no'),
    ],

    'root' => env('XML_ROOT', 'document'),

    'case' => env('XML_CASE', 'snake'), // 'slug', 'camel', 'studly',
];
