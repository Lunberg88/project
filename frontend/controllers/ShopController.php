<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Ship;

class ShopController extends Controller
{
    public function actionIndex()
    {
        $shopProvider = new ActiveDataProvider([
            'pagination' => [
              'pageSize' => 20,
            ],
            'query' => Ship::find()
                       ->orderBy('lvl DESC')
                       ->limit(20)
        ]);

        return $this->render('index', [
            'shopProvider' => $shopProvider,
        ]);
    }

}
