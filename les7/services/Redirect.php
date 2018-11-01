<?php
namespace app\services;

class Redirect {
    public function redirectRun($url) {
        header("Location: {$url}");
        exit;
    }
}
?>