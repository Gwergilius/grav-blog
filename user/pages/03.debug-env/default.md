---
title: Environment Debug
cache_enable: false
process:
  twig: true
---

# Environment Debug

## Plugin Configurations

### DotEnv Plugin
{{ vardump(config.plugins.dotenv) }}

### Login Plugin  
{{ vardump(config.plugins.login) }}

### Login OAuth2 Plugin (hyphen notation)
{{ vardump(config.plugins['login-oauth2']) }}

## Environment Variables
```yaml
# Expected values from .env:
# Hyphen notation:
login-oauth2.providers.github.client_id: {{ config.plugins['login-oauth2'].providers.github.client_id ?? 'NOT LOADED' }}
login-oauth2.providers.github.client_secret: {{ config.plugins['login-oauth2'].providers.github.client_secret ?? 'NOT LOADED' }}
```

## Complete Plugin Config
{{ vardump(config.plugins) }}