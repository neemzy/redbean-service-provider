<?php

namespace Neemzy\Silex\Provider\RedBean;

use Silex\Application;

class Instance
{
    /**
     * @var Silex\Application App to bind
     */
    protected $app;



    /**
     * Constructor
     * Sets up database connection
     *
     * @param Silex\Application $app App to read connection parameters from and bind to model instances
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->setup($app['redbean.database'], $app['redbean.username'], $app['redbean.password']);
    }



    /**
     * Magic method
     * Passes all calls to RedBean's singleton
     *
     * @return mixed
     */
    public function __call($method, $params)
    {
        $return = call_user_func_array('\RedBean_Facade::'.$method, $params);

        // We're dealing with a bean, so let's bind our app to it
        if (in_array($method, ['dispense', 'load', 'dup']) && ($return instanceof \RedBean_OODBBean)) {
            $model = $return->box();

            if ($model instanceof Model) {
                $model->bindApp($this->app);
                $return = $model;
            }
        }

        return $return;
    }
}
