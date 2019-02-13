<?php
namespace controllers;

use farkens\core\Controller;
use farkens\core\Farkens;

/**
 * Description of SiteController
 *
 * @author Программист
 */
class SiteController extends Controller {
    public function actionTest() {

        if(!$users = Farkens::$app->cache->get('users')){
            $u = new \models\User();
            $users = $u->findAll();
            Farkens::$app->cache->set('users', $users);
        }

        return $this->render('test', ['users' => $users ] );
    }
}
