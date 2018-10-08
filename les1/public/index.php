<?php
class AnyThingShop {
    protected static $id;

    public function __construct() {
        static::$id++;
    }

    public function getInfoForPrint() {
        return '<div><p>Абстрактная сущность в интернет-магазине:</p> ' . $this->getId() . '</div>';
    }

    protected function getInfo() {
        return $this->getId();
    }

    protected function getId() {
        return '<p>Id: ' . static::$id . '.</p>';
    }
}

class Product extends AnyThingShop {
    public $name;
    public $cost;
    public $description;
    protected static $id;

    public function __construct($name = '', $cost = 0, $description = '') {
        parent::__construct();
        $this->name = $name;
        $this->cost = $cost;
        $this->description = $description;
    }

    public function getInfoForPrint(){
        return '<div><p>Товар в интернет магазине: </p>' . $this->getInfo() . '</div>';
    }

    protected function getInfo() {
        return parent::getInfo() . $this->getName() . $this->getCost() . $this->getDescription();
    }

    protected function getName() {
        return '<p> Название продукта: ' . $this->name . '.</p>';
    }

    protected function getCost() {
        return '<p> Цена продукта: ' . $this->cost . ' руб.</p>';
    }

    protected function getDescription() {
        return '<p>Описание продукта: ' . $this->description . '.</p>';
    }
}

class Comment extends AnyThingShop {
    public $nameUser;
    public $title;
    public $message;
    protected static $id;

    public function __construct($nameUser = '', $title = '', $message = '') {
        parent::__construct();
        $this->nameUser = $nameUser;
        $this->title = $title;
        $this->message = $message;
    }

    public function getInfoForPrint(){
        return '<div><p>Отзыв в интернет магазине: </p>' . $this->getInfo() . '</div>';
    }

    protected function getInfo() {
        return  parent::getInfo() . $this->getNameUser() . $this->getTitle() . $this->getMessage();
    }

    protected function getNameUser() {
        return '<p> Имя пользователя, оставившего комментарий: ' . $this->nameUser . '.</p>';
    }

    protected function getTitle() {
        return '<p> Заголовок комментария: ' . $this->title . '.</p>';
    }

    protected function getMessage() {
        return '<p>Текст комментария: ' . $this->message . '.</p>';
    }
}

class User extends AnyThingShop {
    public $name;
    public $login;
    protected static $id;

    public function __construct($name = '', $login = '') {
        parent::__construct();
        $this->name = $name;
        $this->login = $login;
    }

    public function getInfoForPrint(){
        return '<div><p>Пользователь в интернет магазине: </p>' . $this->getInfo() . '</div>';
    }

    protected function getInfo() {
        return  parent::getInfo() . $this->getName() . $this->getLogin();
    }

    protected function getName() {
        return '<p> Имя пользователя: ' . $this->name . '.</p>';
    }

    protected function getLogin() {
        return '<p> Логин пользователя: ' . $this->login . '.</p>';
    }
}

$a = new AnyThingShop();
echo $a->getInfoForPrint();
$b = new AnyThingShop();
echo $b->getInfoForPrint();

$product = new Product('Пинетки', 100, 'Пинетки для малышей');
echo $product->getInfoForPrint();
$product1 = new Product('Боди', 250, 'Боди для малышей');
echo $product1->getInfoForPrint();

$comment = new Comment('Галина', 'Новый отзыв', 'Спасибо за работу');
echo $comment->getInfoForPrint();
$comment1 = new Comment('Анна', 'Мой отзыв', 'Ужасная работа сотрудников');
echo $comment1->getInfoForPrint();

$user = new User('Администратор', 'Admin');
echo $user->getInfoForPrint();
$user1 = new User('Галина', 'Galina');
echo $user1->getInfoForPrint();
?>