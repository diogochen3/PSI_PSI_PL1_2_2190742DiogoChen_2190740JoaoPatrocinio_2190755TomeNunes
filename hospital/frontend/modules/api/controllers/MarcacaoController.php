<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class MarcacaoController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Marcacao';
    public function actionIndex()
    {
        return $this->render('index');
    }

}
