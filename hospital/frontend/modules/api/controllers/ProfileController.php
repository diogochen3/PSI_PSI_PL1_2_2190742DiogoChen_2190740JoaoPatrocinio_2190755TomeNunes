<?php

namespace frontend\modules\api\controllers;

use yii\helpers\VarDumper;
use yii\rest\ActiveController;

class ProfileController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Profile';

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionTotal()
    {
        $climodel= new$this->modelClass;
        $recs= $climodel::find()->all();
        return['total' => count($recs)];
    }
}