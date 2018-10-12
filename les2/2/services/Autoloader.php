<?php
class Autoloader {
    private $nameSpaceRoot = 'app';

    public function loadClass($className) {
        $path = str_replace('\\', '/', $className);
        $fileName = str_replace($this->nameSpaceRoot . '/', $_SERVER['DOCUMENT_ROOT'] . '/../', $path) . '.php';

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}