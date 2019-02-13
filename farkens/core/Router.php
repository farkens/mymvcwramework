<?php
namespace farkens\core;

/**
 * Description of Router
 *
 * @author Farkens
 */
class Router {
    
    private static $route = [];

    // parse request from user
    public function getRouters($uri = ''){
        
       //clear /
       $uri_request = trim(urldecode( $uri ? $uri : filter_input(INPUT_SERVER, 'REQUEST_URI')), '/');
       
       // separator get params
       $uri_arr = explode('?', $uri_request);
       
       if( $uri_arr[0] ){
           $path_route = explode('/', $uri_arr[0]);

           self::$route['controller']  = array_shift($path_route);
           self::$route['action']  = array_shift($path_route);
       }

    }
    
    public function redirection(){
        $controller =  'controllers' . DS . ucfirst( empty(self::$route['controller']) ? Farkens::$config['router']['controller'] : self::$route['controller'] ) . 'Controller';
        //check controller
        if(class_exists($controller) ){
            $objController = new $controller;
            //check method
            $method = 'action' . ucfirst( empty(self::$route['action']) ? Farkens::$config['router']['action'] : self::$route['action'] );
            if(method_exists($objController, $method)){
                $objController->$method();
            }else{
                //load 404
                //print_r('не существует' . $method);
                $this->ErrorPage404();
            }
        }else{
            //load 404
            //print_r('не существует' . $controller);
            $this->ErrorPage404();
        }
    }

    function ErrorPage404(){
        $host = 'http://' . $_SERVER['HTTP_HOST'] . Farkens::$config['404'];
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");

        self::$route['controller'] = 'site';
        self::$route['action'] = '404';
        $this->redirection();

    }

    
}
