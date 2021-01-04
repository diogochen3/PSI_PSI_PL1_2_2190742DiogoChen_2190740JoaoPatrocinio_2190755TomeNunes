<?php

namespace frontend\modules\api\controllers;

class ReceitasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
