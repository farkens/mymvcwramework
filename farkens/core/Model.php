<?php

namespace farkens\core;

/**
 * Description of Model
 *
 * @author Farkens
 * realised by singletone
 */
abstract class Model {
    
    private $pdo;
    
    public $table;


    public function __construct() {
        $this->pdo = Db::connect();
    }
    
    
    public function __clone() {
        
    }
    
    public function __wakeup() {
        
    }
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
    
}
