<?php
namespace app\controllers;
use \app\base\App as App;

class OrderController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $idUser = App::call()->session->get('user_id');
        App::call()->repository->order->makeOrder($idUser);
        App::call()->redirect->redirectRun($_SERVER['HTTP_REFERER']);
    }

    public function actionCancel() {
        $idOrder = App::call()->request->getParam('id');
        App::call()->repository->order->cancelOrder($idOrder);
    }
}
?>
