<?php
namespace app\models\repositories;

class AppRepository {
    function __get($name) {
        $class = __NAMESPACE__ . '\\' . ucfirst($name) .'Repository';
        return new $class();
    }
}
?>