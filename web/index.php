<?php
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
define('DEBUG', true);
// a single point og entry
//start timer
$start = microtime(true);
// autoload
require_once ROOT . DS . 'farkens' . DS . 'autoload.php';
// runing app
\farkens\core\Farkens::run();

echo $time = '<br/>Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';