<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class ProfileController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Profile';
    public function actionIndex()
    {
        return $this->render('index');
    }

}
