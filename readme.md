# Laravel Discord Report

It is a package to send errors that are logged in the Laravel application directly to a Discord channel.

### - Install vía [Composer](https://packagist.org/packages/oscarweb/laravel-discord-report "Composer")
Just add this line to your `composer.json` file:
```json
"oscarweb/laravel-discord-report": "0.1.1"
```
or run

```sh
composer require oscarweb/laravel-discord-report
```

### - Publish the service provider
```sh
php artisan vendor:publish --provider "LaravelDiscordReport\ServiceProvider"
```

### - Add a Webhook
In your .env file you need to add the environment variable.
```
LDR_WEBHOOK_URL="https://discord.com/api/webhooks/.../..."
```

### - Add Channel
You must add the new channel to your configuration file.
```php
# /config/loggin.php

return [
    /** ... */
    'default' => env('LOG_CHANNEL', 'stack'),
    /** ... */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            //add channel: laravel_discord_report ↓
            'channels' => ['single','laravel_discord_report'], 
            'ignore_exceptions' => false,
        ],
```

### - Save Config
```sh
php artisan config:cache
```
### - Testing

![Example Command](https://oscarweb.com.ar/github/laravel-discord-report/screenshot_laravel_discord_report.png "Example Command")