<?php

namespace Neemzy\Silex\Provider\RedBean;

class Instance
{
    /**
     * @var string Database connection string
     */
    protected $connectionString;

    /**
     * @var string Database connection username
     */
    protected $username;

    /**
     * @var string Database connection password
     */
    protected $password;



    /**
     * Constructor
     *
     * Sets up database connection
     *
     * @return void
     */
    public function __construct($connectionString, $username, $password)
    {
        $this->setup($connectionString, $username, $password);
    }



    /**
     * Magic method
     * Passes all calls to RedBean's singleton
     *
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array('\RedBean_Facade::'.$method, $params);
    }
}
