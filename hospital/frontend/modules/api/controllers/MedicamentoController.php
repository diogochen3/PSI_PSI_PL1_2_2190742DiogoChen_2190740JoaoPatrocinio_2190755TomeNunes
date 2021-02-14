<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class MedicamentoController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Medicamento';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
