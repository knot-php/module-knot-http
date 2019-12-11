<?php
$base_dir = dirname(__DIR__);
require_once $base_dir . '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    if (strpos($class, 'KnotModule\\KnotHttp\\Test\\') === 0) {
        $name = substr($class, strlen('KnotModule\\KnotHttp\\Test\\'));
        $name = array_filter(explode('\\',$name));
        $file = __DIR__ . '/include/' . implode('/',$name) . '.php';
        if (is_file($file)){
            /** @noinspection PhpIncludeInspection */
            require_once $file;
        }
    }
});