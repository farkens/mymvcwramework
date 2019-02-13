<?php

namespace farkens\core;
use PDO;
/**
 * Description of Db
 *
 * @author Farkens
 */
class Db {
    protected $pdo;
    
    protected static $instance = null;
    
    protected function __construct() {
        $config = require_once ROOT . DS . 'config' . DS . 'db.php';
        $this->pdo = new PDO('mysql:host=localhost;dbname=' . $config['dbname'], $config['user'], $config['pass']);
    }
    
    public static function connect() {
        if( self::$instance === NULL ){
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    protected function __clone() {
        return FALSE;
    }
    
    public function execute($sql, $params = []) {
        $slmt = $this->pdo->prepare($sql);
        return $slmt->execute($params);
    }

    public function query($sql, $params = []) {
        $slmt = $this->pdo->prepare($sql);
        $res = $slmt->execute($params);
        if($res !== FALSE){
            return $slmt->fetchAll(PDO::FETCH_ASSOC );// PDO::FETCH_NUM
        }
        if($res === FALSE){
            return FALSE;
        }
        return [];
    }
}
