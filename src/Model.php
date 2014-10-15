<?php

namespace Neemzy\Silex\Provider\RedBean;

use Silex\Application;

abstract class Model extends \RedBean_SimpleModel
{
    /**
     * @var Silex\Application Binded app
     */
    protected $app;



    /**
     * Binds app to the modem
     *
     * @param Silex\Application $app App to bind
     *
     * @return void
     */
    public function bindApp(Application $app)
    {
        $this->app = $app;
    }
}
