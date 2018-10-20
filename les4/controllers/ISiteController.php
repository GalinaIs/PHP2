<?php
namespace app\controllers;

interface ISiteController {
    public function run($action = null);
    public function renderTemplate($template, $params = []);
    public function render($template, $params = []);
}
?>