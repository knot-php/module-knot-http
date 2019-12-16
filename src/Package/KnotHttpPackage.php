<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotHttp\Package;

use KnotLib\Kernel\Module\PackageInterface;
use KnotPhp\Module\KnotHttp\KnotHttpResponderModule;
use KnotPhp\Module\KnotHttp\KnotHttpRoutingMiddlewareModule;

class KnotHttpPackage implements PackageInterface
{
    /**
     * Get package module list
     *
     * @return string[]
     */
    public static function getModuleList() : array
    {
        return [
            KnotHttpResponderModule::class,
            KnotHttpRoutingMiddlewareModule::class,
        ];
    }
}