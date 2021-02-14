<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class HorarioController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Horario';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHorarionew($id)
    {
        $usado = Yii::$app->request->post("usado");
        $climodel= new $this->modelClass;
        $rec= $climodel::find()->where("id=".$id)->one();

        if($rec !== null){
            $rec->usado = $usado;
            $rec->save();
            return $rec;
        }
        throw new NotFoundHttpException("Clientid notfound!");

    }
}
