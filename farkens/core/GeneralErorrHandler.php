<?php
/**
 * User: Farkens
 */

namespace farkens\core;


class GeneralErorrHandler{

    public function __construct() {
        if (DEBUG === TRUE) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        // set custom error handler
        set_error_handler([$this, 'errorHandler']);
        // start buffering
        ob_start();
        // function after finish scripts
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }
    /*
     * custom error handler
     */
    public function errorHandler($errno, $errstr, $errfile, $errline) {
        //write logs
        $this->errorLog($errstr, $errfile, $errline);
        //show errors
        $this->showDebug($errno, $errstr, $errfile, $errline);
        /* don't run personal error handler PHP */
        return true;
    }
    /**
     *   Fatal error interception function
     */
    function fatalErrorHandler() {
        // error is fatal
        if ($error = error_get_last() AND $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            // clear buffer
            ob_end_clean();
            // run our error handler
            $this->errorHandler($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            // show buffer
            ob_end_flush();
        }
    }
    /*
     * show error on screen
     */
    protected function showDebug($errno, $errstr, $errfile, $errline, $response = 500) {
        http_response_code($response);
        if($response == 404){
            //require ROOT . DS . 'views' . DS . 'errors' . DS . '404.php';
            die;
        }
        if(DEBUG === TRUE){
            echo '<pre>';
            print_r($errno . '<br/>' . $errstr. '<br/>' . $errfile. '<br/>' . $errline);
            echo '</pre>';
        }else{
            echo 'На сайте возникла техничиская неполадка, обратитесь к администратору. С нетерпениеем ждем вас позже=)';
        }
        die;

    }

    /*
     * write error on log file
     */
    protected function errorLog($message = '', $file = '', $line = ''){
        $path_file_error = ROOT . DS . "tmp" . DS . "error" . DS;
        if(!is_dir($path_file_error)){
            mkdir($path_file_error,0777, true);
        }
        error_log( "[" . date('Y-m-d H:i:s') . "] Error:" . $message . " file: " . $file . " row: " . $line ."\n", 3, $path_file_error . "error.txt" );

    }

}