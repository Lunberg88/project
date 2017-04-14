<?php

namespace frontend\controllers;

use Yii;
use common\models\Battles;
use common\models\User;
use \yii\web\Controller;

class ListController extends Controller
{
    public function actionIndex()
    {
        /**
         * Battle list params.
         *
         * @param $battle_id
         * @param $user
         */
        $session = Yii::$app->session;
        $session->open();
        $session['battle_id'] = date('dmhs');
        $user = User::findOne(['id' => Yii::$app->user->id]);

        /**
         * Checking the battle's params.
         * Redirect to the combat page.
         */
        if(Yii::$app->request->post('start')) {
            $bid = new Battles();
            $bid->bid = $session['battle_id'];
            $bid->creator_id = $user->id;
            $bid->status = 0;
            $bid->date = date('d.m.Y');
            $bid->save();

            $user->updateAll(['battle_id' => $session['battle_id']], ['id' => $user->id]);
            $this->redirect(Yii::$app->homeUrl.'/combat');
        }
        return $this->render('index', [
            'user' => $user,
        ]);
    }

}
