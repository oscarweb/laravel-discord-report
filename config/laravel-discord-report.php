<?php
    /*
    |--------------------------------------------------------------------------
    | Laravel Discord Report
    |--------------------------------------------------------------------------
    */
return [
    /** Deshabilitar reportes de error, default: false */
    'disabled' => env('LDR_DISABLED', false),

    /** WebHook Discord Channel */
    'webhook' => [
        /** url webhook */
        'url' => env('LDR_WEBHOOK_URL', null),

        /** opcional nombre para el bot */
        'username' => env('LDR_WEBHOOK_USERNAME', null),

        /** url del avatar para el bot */
        'avatar' => env('LDR_WEBHOOK_AVATAR', null),
    ],

    /** Opciones de formato en el mensaje */
    'format' => [
        /** Agrega la URL en el mensaje de error. */
        'url' => true,

        /** Muestra la IP del solicitante. */
        'ip' => true,

        /** Por defecto los iconos están habilitados. */
        'icons' => true,
        
        /** Se enviará por defecto con formato de código entre: ``` */
        'code' => true,
    ],
    
    /** Iconos enviados en el mensaje de error */
    'icons' => [
        'url'     => '🌏',
        'ip'      => '👀',
        'message' => '🚩'
    ],
    
    /** Opciones para: Illuminate\Support\Facades\Http */
    'client' => [
        'headers' => [],
        'options' => []
    ],    
];