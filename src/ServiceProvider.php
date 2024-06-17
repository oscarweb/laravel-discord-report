<?php
namespace LaravelDiscordReport;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use LaravelDiscordReport\Logging\LaravelDiscordReport;

class ServiceProvider extends BaseServiceProvider{
    /**
     * Register services.
     * -
     * @return void
     */
    public function register(){
        $this->app->singleton('discord.report', function ($app) {
            return new LaravelDiscordReport();
        });
    }

    /**
     * Bootstrap services.
     * -
     * @return void
     */
    public function boot(){
        // Agrega el custom channel a la config logging.php
        $this->app['config']->set('logging.channels.laravel_discord_report', [
            'driver' => 'custom',
            'via' => LaravelDiscordReport::class,
            'level' => 'error',
        ]);

        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-discord-report.php' => config_path('laravel-discord-report.php'),
            ]);
        }
    }
}