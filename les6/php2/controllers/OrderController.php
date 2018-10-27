<?php
namespace app\controllers;
//use \app\models\Basket as Basket;

class OrderController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $idUser = 1;
        $this->repository->makeOrder($idUser);
        (new \app\services\Redirect())->redirect($_SERVER['HTTP_REFERER']);
    }
}
?>
