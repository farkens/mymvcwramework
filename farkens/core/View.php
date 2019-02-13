<?php
/**
 * MAin View.
 * User: Farkens
 */

namespace farkens\core;


class View{

    public $layout = 'main';

    public function view($view,$data){
        $pathViewController = ROOT . DS . 'views' . DS . 'site' . DS . $view . '.php';
        //extract data from user
        extract($data);
        //bufer of view template
        ob_start();
        if(file_exists($pathViewController)){
            require_once $pathViewController;
        }else{
            echo 'Вид ' . $pathViewController . ' Не найден!';
        }
        // variable for use in template
        $content = ob_get_clean();

        $pathLayout = ROOT . DS . 'views' . DS . 'layout' . DS .  $this->layout . '.php';

        if(file_exists($pathLayout)){
            require_once $pathLayout;
        }else{
            echo 'Шаблон ' . $pathLayout . ' Не найден!';
        }
    }
}