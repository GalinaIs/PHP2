<?php
namespace app\controllers;

class ErrorController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex($error) {
        echo $this->render('error', ['error' => $error]);
    }
}
?>
