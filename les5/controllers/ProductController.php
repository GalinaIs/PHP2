<?php
namespace app\controllers;

class ProductController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $arrayModel = \app\models\Product::getAll();
        foreach ($arrayModel as $model) {
            $model->getOneImage();
        }
        echo $this->render('products', ['arrayModel' => $arrayModel]);
    }

    public function actionCard() {
        $id = $_GET['id'];
        $model = \app\models\Product::getOne($id);
        if ($model) {
            $images = $model->getAllImage();
        }
        echo $this->render('card', [
            'model' => $model,
            'images' => $images
        ]);
    }
}
?>
