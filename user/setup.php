<?php

// Load environment variables for OAuth2 plugin
$envFile = __DIR__ . '/../.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && !str_starts_with($line, '#')) {
            [$key, $value] = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

return [
    'plugins' => [
        'login-oauth2' => [
            'enabled' => true,
            'providers' => [
                'github' => [
                    'enabled' => true,
                    'credentials' => [
                        'client_id' => getenv('GITHUB_CLIENT_ID') ?: '',
                        'client_secret' => getenv('GITHUB_CLIENT_SECRET') ?: ''
                    ],
                    'options' => [
                        'scope' => ['user:email']
                    ]
                ]
            ]
        ]
    ]
];