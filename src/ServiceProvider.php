<?php

namespace Neemzy\Silex\Provider\RedBean;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers this service on the given app
     *
     * @param Silex\Application $app Application instance
     *
     * @return void
     */
    public function register(Application $app)
    {
        $app['redbean'] = $app->share(function () use ($app) {
            return new Instance($app);
        });
    }



    /**
     * Bootstraps the application
     *
     * @return void
     */
    public function boot(Application $app)
    {
    }
}
