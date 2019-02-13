<?php
/**
 * Main Controller
 * User: Farkens
 */

namespace farkens\core;


class Controller{

    public function render($view, $data = []){
        $objView = new View();
        $objView->view($view,$data);
    }
    public function action404(){
        return $this->render('404');
    }
}