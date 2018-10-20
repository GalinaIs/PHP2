<?php
namespace app\controllers;

class CartController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        echo $this->render('cart', [
            'cart' => [],
            'cost' => ''
        ]);
    }
}
?>
