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



    private function boxIfModel(\RedBean_OODBBean $bean)
    {
        $model = $bean->box();

        if (!($model instanceof Model)) {
            return $bean;
        }

        $model->bindApp($this->app);
        return $model;
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

        // If we are dealing with beans, we bind our app to them
        if ($return instanceof \RedBean_OODBBean) {
            return $this->boxIfModel($return);
        } else if (is_array($return)) {
            foreach ($return as $key => $value) {
                if ($value instanceof \RedBean_OODBBean) {
                    $return[$key] = $this->boxIfModel($value);
                }
            }
        }

        return $return;
    }
}
