<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class ReceitasconsultasController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\ReceitasConsultas';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
