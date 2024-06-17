<?php
namespace LaravelDiscordReport\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LaravelDiscordReportHandler extends AbstractProcessingHandler{
    public function __construct($level = Logger::ERROR, $bubble = true){
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void{
        /** mensaje formateado de error */
        $message = $record['formatted'];
        
        /**  */
        $request = request();
        
        /** parámetros a enviar */
        $params = [];

        /** si code está habilitado */
        $prefix = (config('laravel-discord-report.format.code'))? '```' : '';
        
        /** */
        $content = $prefix;

        /** si está habilitada la url */
        if(config('laravel-discord-report.format.url')){
            $icon_url = (config('laravel-discord-report.format.icons'))? config('laravel-discord-report.icons.url').' ' : '';
            
            $content .= $icon_url.'['.$request->method().'] '.self::excerpt($request->fullUrl()).PHP_EOL;
        }

        /** si está habilitada la ip */
        if(config('laravel-discord-report.format.ip')){
            $icon_ip = (config('laravel-discord-report.format.icons'))? config('laravel-discord-report.icons.ip').' ' : '';
            $content .= $icon_ip.'[IP] '.$request->ip().PHP_EOL;
        }

        /** mensaje */
        $icon_message = (config('laravel-discord-report.format.icons'))? config('laravel-discord-report.icons.message').' ' : '';
        $content .= $icon_message.$message.$prefix;

        /** si se seteó usuario para el bot */
        if(config('laravel-discord-report.webhook.username')){
            $params['username'] = config('laravel-discord-report.webhook.username');
        }

        /** si agregó la url de un avatar */
        if(config('laravel-discord-report.webhook.avatar')){
            $params['avatar_url'] = config('laravel-discord-report.webhook.avatar');
        }

        /** agregamos mensaje con formato */
        $params['content'] = $content;        
        

        if(config('laravel-discord-report.webhook.url')){
            Http::withHeaders(config('laravel-discord-report.client.headers'))
                ->withOptions(config('laravel-discord-report.client.options'))
                ->post(config('laravel-discord-report.webhook.url'), $params);            
        }
        else{
            throw new \Exception('Laravel Discord Report: No se encontró la url del webhook!');
        }        
    }

    /**
     * Limits the length of a string
     * -
     * @param string $text
     * @param int    $limit
     * @return string
     */
    static public function excerpt($text = '', $limit = 130){
        if(strlen($text) > $limit){
            return substr($text, 0, $limit).'...';
        }

        return $text;
    }
}