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
}
?>
