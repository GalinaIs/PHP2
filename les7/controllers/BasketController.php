<?php
namespace app\controllers;
use \app\models\Basket as Basket;
use \app\base\App as App;

class BasketController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $idUser = App::call()->session->get('user_id');
        $cart = App::call()->repository->basket->getFullBasket($idUser);
        $cost = App::call()->repository->basket->getCost($cart);

        echo $this->render('basket', [
            'cart' => $cart,
            'cost' => $cost
        ]);
    }

    public function actionChange() {
        $count = App::call()->request->getParam('qty');
        $idProduct = App::call()->request->getParam('id');
        $action = App::call()->request->getParam('action');
        $redirect = App::call()->request->getParam('redirect');
        
        $idUser = App::call()->session->get('user_id');

        App::call()->repository->basket->changeBasket($action, $idProduct, $count, $idUser);

        if ($redirect) {
            App::call()->redirect->redirectRun($_SERVER['HTTP_REFERER']);
        } else {
            echo json_encode(['success' => 'ok', 'message' => 'Корзина успешно изменена!']);
        }
    }
}
?>
