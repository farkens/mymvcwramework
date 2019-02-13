<?php
/**
 * User: Farkens
 */
namespace farkens\components;

class Cache
{
    private $path_cache = ROOT . DS . "tmp" . DS . "cache" . DS;

    public function __construct()
    {
        $this->checkDirCache();
    }

    public function set($key, $date, $time = 3600) {
        $content['date'] = $date;
        $content['end_time'] = time() + $time;
        if (file_put_contents($this->path_cache. md5($key) . '.txt', serialize($content))) {
            return true;
        }
        return false;
    }
    public function get($key) {
        $filePath = $this->path_cache . md5($key) . '.txt';
        if (file_exists($filePath)) {
            $content = unserialize(file_get_contents($filePath));
            if (time() <= $content['end_time']) {
                return $content['date'];
            } else {
                unlink($filePath);
            }
        }
        return false;
    }
    public function delete($key) {
        $filePath = $this->path_cache . md5($key) . '.txt';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private function checkDirCache(){
        if(!is_dir($this->path_cache)){
            mkdir($this->path_cache,0777, true);
        }
    }
}