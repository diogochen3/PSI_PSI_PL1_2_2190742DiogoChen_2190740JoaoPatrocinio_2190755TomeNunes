<?php

namespace frontend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class EspecialidadeController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Especialidade';
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
    public function actionEspecialidadedel($id)
    {

        $climodel= new$this->modelClass;
        $ret=$climodel->deleteAll("id=".$id);
        if($ret)
        {
            Yii::$app->response->statusCode=200;
            return['code'=>'ok'];
        }
        Yii::$app->response->statusCode=404;
        return ['code'=>'error'];
    }



    public function actionSet($limit)
    {
        $climodel= new $this->modelClass;
        $recs = $climodel::find()->limit($limit)->all();
        return ['limite' => $limit, 'Records' => $recs];
    }
    public function actionCespecialidade()    {
        $name = Yii::$app->request->post("Name");
        $climodel= new $this->modelClass;
        $climodel->Name=$name;
        $ret = $climodel->save();
        if($ret)
            return 'Saved';
        else
        {
            $err = json_encode( $climodel->getErrors() );
            throw new \yii\web\HttpException(422, $err );
        }
    }
    public function actionEspecialidadenew($id)    {
        $name = Yii::$app->request->post("Name");
        $climodel= new $this->modelClass;
        $rec= $climodel::find()->where("id=".$id)->one();


        if($rec !== null){
            $rec->Name=$name;
            $rec->save();
            return['SaveError' => 'Ok'];
        }
        throw new NotFoundHttpException(" ID Especialidade notfound!");



    }

}
