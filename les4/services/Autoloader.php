<?php
class Autoloader {
    private $nameSpaceRoot = 'app\\';

    public function loadClass($className) {
        $fileName = str_replace([$this->nameSpaceRoot, '\\'], [ROOT_DIR, '/'], $className) . '.php';

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}