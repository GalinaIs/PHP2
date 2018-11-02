<?php
namespace app\controllers;
use \app\base\App as App;

class ProductController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $arrayModel = App::call()->repository->product->getAll();
        foreach ($arrayModel as $model) {
            App::call()->repository->product->getOneImage($model);
        }
        echo $this->render('products', ['arrayModel' => $arrayModel]);
    }

    public function actionCard() {
        $id = App::call()->request->getParam('id');
        $model = App::call()->repository->product->getOne($id);
        if ($model) {
            $images = App::call()->repository->product->getAllImage($model);
        }

        echo $this->render('card', [
            'model' => $model,
            'images' => $images
        ]);
    }

    public function actionChange() {
        $userId = App::call()->session->get('user_id');
        if ($userId == 1) {
            $error = false;
            $products = App::call()->repository->product->getAll();
        } else {
            $error = true;
            $products = [];
        }

        echo $this->render('changeProduct', [
            'error' => $error,
            'products' => $products
        ]);
    }

    public function actionAddProduct() {
        $request = App::call()->request;
        $name = $request->getParam('name');
        $price = $request->getParam('price');
        $shortDesc = $request->getParam('short_desc');
        $fullDesc = $request->getParam('full_desc');
    
        App::call()->repository->product->addNewProduct($name, $price, $shortDesc, $fullDesc);
        
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionChangeProduct() {
        $request = App::call()->request;
        $name = $request->getParam('name');
        $price = $request->getParam('price');
        $shortDesc = $request->getParam('short_desc');
        $fullDesc = $request->getParam('full_desc');
        $idProduct = $request->getParam('id_product');

        App::call()->repository->product->changeProduct($name, $price, $shortDesc, $fullDesc, $idProduct);
    
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionDeleteProduct() {
        $idProduct = App::call()->request->getParam('id_product');
    
        App::call()->repository->product->deleteProduct($idProduct);
    
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
?>
