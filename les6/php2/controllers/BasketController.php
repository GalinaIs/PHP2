<?php
namespace app\controllers;
use \app\models\Basket as Basket;

class BasketController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $idUser = 1;
        $cart = $this->repository->getFullBasket($idUser);
        $cost = $this->repository->getCost($cart);

        echo $this->render('basket', [
            'cart' => $cart,
            'cost' => $cost
        ]);
    }

    public function actionChange() {
        $count = $_POST['qty'];
        $idProduct = $_POST['id'];
        $action = $_POST['action'];
        $redirect = $_POST['redirect'];

        /*$count = $this->request->post('qty');
        $idProduct = $this->request->post('id');
        $action = $this->request->post('action');
        $redirect = $this->request->post('redirect'); не работает в случае ajax запроса, т.к. нет перезагрузки*/
        
        $idUser = 1;

        $item = $this->repository->changeBasket($action, $idProduct, $count, $idUser);

        if ($redirect) {
            (new \app\services\Redirect())->redirect($_SERVER['HTTP_REFERER']);
        } else {
            echo json_encode(['success' => 'ok', 'message' => 'Корзина успешно изменена!']);
        }
    }
}
?>
