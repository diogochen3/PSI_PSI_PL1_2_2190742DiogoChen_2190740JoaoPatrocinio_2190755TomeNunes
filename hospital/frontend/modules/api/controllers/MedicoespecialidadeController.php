<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

class MedicoespecialidadeController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\MedicoEspecialidade';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
