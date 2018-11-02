<?php
namespace app\controllers;
use \app\base\App as App;

class UserController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        if ($userId = App::call()->session->get('user_id')) {
            $this->redirect('/user/account');
        } else {
            $this->redirect('/user/login');
        }
    }

    public function actionAccount() {
        $userId = App::call()->session->get('user_id');
        if (!$userId) {
            $this->redirect('/user/login');
        }

        $user = App::call()->repository->user->getOne($userId);
        $orders = App::call()->repository->user->getOrdersByUserId($userId);

        echo $this->render('account', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function actionLogin() {
        $request = App::call()->request;
        $login = $request->getParam('login');
        $password = $request->getParam('password');
        $user = App::call()->repository->user->getUserByLoginPass($login, $password);

        if ($user) {  
            App::call()->session->set('user_id', $user->id);
            $this->redirect('/user/account');
        } else {
            $message = '';
            if (isset($login) || isset($password)) {
                $message = 'Неверная пара: логин и пароль';
            }
            echo $this->render('login', ['message' => $message]);
        }
    }

    public function actionRegistration() {
        $request = App::call()->request;
        $login = $request->getParam('login');
        $password = $request->getParam('password');
        $name = $request->getParam('name');
        $message = '';

        if (isset($login) || isset($password) || isset($name)) {
            if ( App::call()->repository->user->resultUserRegistration($login, $password, $name)){
                $user = App::call()->repository->user->getUserByLoginPass($login, $password);
                App::call()->session->set('user_id', $user->id);
                App::call()->repository->basket->createBasketNewUser($user->id);
                $this->redirect('/user/account');
            } else {
                $message = "Пользователь с такой парой - логин и пароль уже существует!"; 
            }
        }

        echo $this->render('registration', ['message' => $message]);
    }
}
?>
