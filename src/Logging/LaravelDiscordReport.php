<?php
namespace LaravelDiscordReport\Logging;

use Monolog\Logger;

use LaravelDiscordReport\Logging\LaravelDiscordReportHandler;

class LaravelDiscordReport{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config){
        /** Si está deshabilitado */
        if(config('laravel-discord-report.disabled')){
            return $logger;
        }

        $logger = new Logger('LaravelDiscordReport');
        $logger->pushHandler(new LaravelDiscordReportHandler(Logger::ERROR));
        return $logger;
    }
}