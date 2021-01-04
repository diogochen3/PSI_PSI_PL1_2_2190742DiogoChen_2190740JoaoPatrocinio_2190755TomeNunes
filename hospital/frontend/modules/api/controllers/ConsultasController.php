<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class ConsultasController extends ActiveController
{

    public $modelClass = 'frontend\modules\api\models\Consultas';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
