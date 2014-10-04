<?php

namespace Neemzy\Silex\Provider\RedBean;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @var Patchwork\RedBean\Instance RedBean "instance"
     */
    protected $instance;



    /**
     * Constructor
     *
     * Crafts RedBean instance with given database connection parameters
     *
     * @return void
     */
    public function __construct($connectionString, $username, $password)
    {
        $this->instance = new Instance($connectionString, $username, $password);
    }



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
            return $this->instance;
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
