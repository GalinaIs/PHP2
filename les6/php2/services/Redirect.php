<?php
namespace app\services;

class Redirect {
    public function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}
?>