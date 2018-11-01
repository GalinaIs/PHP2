<?php
namespace app\controllers;
use \app\base\App as App;

class UserController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        if ($userId = App::call()->session->get('user_id')) {
            App::call()->redirect->redirectRun('/user/account');
        } else {
            App::call()->redirect->redirectRun('/user/login');
        }
    }

    public function actionAccount() {
        $userId = App::call()->session->get('user_id');
        if (!$userId) {
            App::call()->redirect->redirectRun('/user/login');
        }

        $user = App::call()->repository->user->getOne($userId);
        $orders = App::call()->repository->user->getOrdersByUserId($userId);

        echo $this->render('account', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function actionLogin() {
        $login = App::call()->request->getParam('login');
        $password = App::call()->request->getParam('password');
        $user = App::call()->repository->user->getUserByLoginPass($login, $password);

        if ($user) {  
            App::call()->session->set('user_id', $user->id);
            App::call()->redirect->redirectRun('/user/account');
        } else {
            $message = '';
            if (isset($login) || isset($password)) {
                $message = 'Неверная пара: логин и пароль';
            }
            echo $this->render('login', ['message' => $message]);
        }
    }

    public function actionRegistration() {
        $login = App::call()->request->getParam('login');
        $password = App::call()->request->getParam('password');
        $name = App::call()->request->getParam('name');
        $message = '';

        if (isset($login) || isset($password) || isset($name)) {
            if ( App::call()->repository->user->resultUserRegistration($login, $password, $name)){
                $user = App::call()->repository->user->getUserByLoginPass($login, $password);
                App::call()->session->set('user_id', $user->id);
                App::call()->repository->basket->createBasketNewUser($user->id);
                App::call()->redirect->redirectRun('/user/account');
            } else {
                $message = "Пользователь с такой парой - логин и пароль уже существует!"; 
            }
        }

        echo $this->render('registration', ['message' => $message]);
    }
}
?>
