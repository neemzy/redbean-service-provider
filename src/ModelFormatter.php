<?php

namespace Neemzy\Silex\Provider\RedBean;

class ModelFormatter implements \RedBean_IModelFormatter
{
    /**
     * @var string Model class namespace
     */
    protected $namespace;



    /**
     * Constructor
     * Binds the namespace to the formatter
     *
     * @param string $namespace Model class namespace
     *
     * @return void
     */
    public function __construct($namespace)
    {
        $this->namespace = rtrim($namespace, '\\');
    }



    /**
     * RedBean model class name formatter
     *
     * @param string $table Table name
     *
     * @return string Full class name
     */
    public function formatModel($table)
    {
        return $this->namespace.'\\'.ucfirst($table);
    }
}
