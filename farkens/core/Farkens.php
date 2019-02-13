<?php
/**
 * User: Farkens
 */

namespace farkens\core;


class Farkens
{
    // obj 
    public static $router;

    //regestry array
    public static $app = [];
    // singletone
    private static $instanse;

    public static $config;

    public static function run()
    {
        if (!isset(self::$instanse)) {
            self::$instanse = new self();
        }
        return self::$instanse;
    }

    /**
     * disable to call from outside to prevent
     * from creating multiple instances,
     * to use the singleton
     */
    private function __construct()
    {
        //add config params for access everywhere
        self::$config = require_once ROOT . DS . 'config' . DS . 'config.php';
        // custom error handler
        new GeneralErorrHandler();
        self::$app = Registry::getInstanse();


        self::$router = new \farkens\core\Router();

        self::$router->getRouters();

        //redirect to our request
        self::$router->redirection();
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }


}