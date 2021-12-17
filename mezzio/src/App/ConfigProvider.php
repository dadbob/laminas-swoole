<?php

declare(strict_types=1);

namespace App;

use Mezzio\Swoole\HttpServerFactory;
use Mezzio\Swoole\PidManager;
use Mezzio\Swoole\PidManagerFactory;
use Mezzio\Swoole\ServerRequestSwooleFactory;
use Mezzio\Swoole\StaticMappedResourceHandler;
use Mezzio\Swoole\StaticMappedResourceHandlerFactory;
use Mezzio\Swoole\StaticResourceHandler;
use Mezzio\Swoole\StaticResourceHandler\FileLocationRepository;
use Mezzio\Swoole\StaticResourceHandler\FileLocationRepositoryFactory;
use Mezzio\Swoole\StaticResourceHandlerFactory;
use Mezzio\Swoole\SwooleRequestHandlerRunner;
use Mezzio\Swoole\SwooleRequestHandlerRunnerFactory;
use Psr\Http\Message\ServerRequestInterface;

use Mezzio\Swoole\Command;
use Mezzio\Swoole\Event;
use Mezzio\Swoole\Log;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,

                Command\ReloadCommand::class                    => Command\ReloadCommandFactory::class,
                Command\StartCommand::class                     => Command\StartCommandFactory::class,
                Command\StatusCommand::class                    => Command\StatusCommandFactory::class,
                Command\StopCommand::class                      => Command\StopCommandFactory::class,
                Event\EventDispatcherInterface::class           => Event\EventDispatcherFactory::class,
                Event\HotCodeReloaderWorkerStartListener::class => Event\HotCodeReloaderWorkerStartListenerFactory::class,
                Event\RequestHandlerRequestListener::class      => Event\RequestHandlerRequestListenerFactory::class,
                Event\ServerShutdownListener::class             => Event\ServerShutdownListenerFactory::class,
                Event\ServerStartListener::class                => Event\ServerStartListenerFactory::class,
                Event\StaticResourceRequestListener::class      => Event\StaticResourceRequestListenerFactory::class,
                Event\SwooleListenerProvider::class             => Event\SwooleListenerProviderFactory::class,
                Event\WorkerStartListener::class                => Event\WorkerStartListenerFactory::class,
                Log\AccessLogInterface::class                   => Log\AccessLogFactory::class,
                Log\SwooleLoggerFactory::SWOOLE_LOGGER          => Log\SwooleLoggerFactory::class,
                PidManager::class                               => PidManagerFactory::class,
                SwooleRequestHandlerRunner::class               => SwooleRequestHandlerRunnerFactory::class,
                ServerRequestInterface::class                   => ServerRequestSwooleFactory::class,
                StaticResourceHandler::class                    => StaticResourceHandlerFactory::class,
                StaticMappedResourceHandler::class              => StaticMappedResourceHandlerFactory::class,
                FileLocationRepository::class                   => FileLocationRepositoryFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
