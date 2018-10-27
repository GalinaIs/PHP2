<?php
namespace app\controllers;

class ProductController extends SiteController {
    protected $defaultAction = 'index';

    public function actionIndex() {
        $arrayModel = $this->repository->getAll();
        foreach ($arrayModel as $model) {
            $this->repository->getOneImage($model);
        }
        echo $this->render('products', ['arrayModel' => $arrayModel]);
    }

    public function actionCard() {
        $id = $this->request->getParam('id');
        $model = $this->repository->getOne($id);
        if ($model) {
            $images = $this->repository->getAllImage($model);
        }

        echo $this->render('card', [
            'model' => $model,
            'images' => $images
        ]);
    }
}
?>
