<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class DiagnosticoController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Diagnostico';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
