# Laravel Discord Report

It is a package to send errors that are logged in the Laravel application directly to a Discord channel.

### - Install vía [Composer](https://packagist.org/packages/oscarweb/laravel-discord-report "Composer")
Just add this line to your `composer.json` file:
```json
"oscarweb/laravel-discord-report": "^0.2.3"
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
In your ```.env``` file you need to add the environment variable.
```sh
LDR_WEBHOOK_URL="https://discord.com/api/webhooks/.../..."
```

### - Add Channel
You must add the new channel to your configuration file: 

```laravel_discord_report```

```php
# /config/logging.php

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

## Other environment variables
You can add these variables in your ```.env``` file
| Name                       | Description                             | Default     |
| -------------------------- | --------------------------------------- | -----------:|
| ```LDR_DISABLED ```        | Disable sending messages to Discord.    | ```false``` |
| ```LDR_WEBHOOK_URL```      | Discord channel webhook URL.            |  ```null``` |
| ```LDR_WEBHOOK_USERNAME``` | Name of the bot in the Discord channel. |  ```null``` |
| ```LDR_WEBHOOK_AVATAR```   | Image URL for the bot avatar.           |  ```null``` |

#### - Example in your ```.env``` file:
```sh
LDR_WEBHOOK_URL="https://discord.com/api/webhooks/.../..."
LDR_WEBHOOK_USERNAME="Test API Report"
LDR_WEBHOOK_AVATAR="https://i.imgur.com/oBPXx0D.png"
```

Save config:
```sh
php artisan config:cache
```