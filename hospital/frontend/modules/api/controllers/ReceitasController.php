<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class ReceitasController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Receitas';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
