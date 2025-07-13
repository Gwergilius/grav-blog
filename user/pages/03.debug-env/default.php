---
title: Environment Debug
---

```php
<?php
$config = $this->grav['config'];

echo "Dotenv plugin enabled: " . ($config->get('plugins.dotenv.enabled') ? 'YES' : 'NO') . "\n";
echo "Login-OAuth2 plugin enabled: " . ($config->get('plugins.login-oauth2.enabled') ? 'YES' : 'NO') . "\n";
echo "GitHub provider enabled: " . ($config->get('plugins.login-oauth2.providers.github.enabled') ? 'YES' : 'NO') . "\n";
echo "Client ID: " . $config->get('plugins.login-oauth2.providers.github.credentials.client_id') . "\n";
echo "Client Secret set: " . ($config->get('plugins.login-oauth2.providers.github.credentials.client_secret') ? 'YES' : 'NO') . "\n";

// Check if file exists
$envFile = GRAV_ROOT . '/.env';
$gravenvFile = GRAV_ROOT . '/.gravenv';
echo "\n.env exists: " . (file_exists($envFile) ? 'YES' : 'NO') . "\n";
echo ".gravenv exists: " . (file_exists($gravenvFile) ? 'YES' : 'NO') . "\n";
?>