<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotHttp;

use Throwable;

use KnotLib\Http\Middleware\HttpRoutingMiddleware;
use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Module\ComponentTypes;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;

use KnotLib\Kernel\Exception\ModuleInstallationException;

class KnotHttpRoutingMiddlewareModule implements ModuleInterface
{
    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }
    
    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponentTypes() : array
    {
        return [
            ComponentTypes::EVENTSTREAM,
            ComponentTypes::PIPELINE,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::MODULE;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $middleware = new HttpRoutingMiddleware($app);

            $app->pipeline()->push($middleware);

            // fire event
            $app->eventstream()->channel(Channels::SYSTEM)->push(Events::PIPELINE_MIDDLEWARE_PUSHED, $middleware);
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException(self::class, $e->getMessage(), 0, $e);
        }
    }
}