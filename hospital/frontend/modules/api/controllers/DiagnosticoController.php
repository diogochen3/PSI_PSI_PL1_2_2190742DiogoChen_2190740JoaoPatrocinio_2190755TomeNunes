<?php

namespace frontend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class DiagnosticoController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Diagnostico';

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
    public function actionDiagnosticodel($id)
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
    public function actionCdiagnostico()    {
        $descricao = Yii::$app->request->post("descricao");
        $date = Yii::$app->request->post("date");
        $situacao = Yii::$app->request->post("situacao");
        $id_medico = Yii::$app->request->post("id_medico");
        $id_utente = Yii::$app->request->post("id_utente");
        $climodel= new $this->modelClass;
        $climodel->descricao=$descricao;
        $climodel->date=$date;
        $climodel->situacao=$situacao;
        $climodel->id_medico=$id_medico;
        $climodel->id_utente=$id_utente;
        $ret = $climodel->save();
        if($ret)
            return 'Saved';
        else
        {
            $err = json_encode( $climodel->getErrors() );
            throw new \yii\web\HttpException(422, $err );
        }
    }
    public function actionDiagnosticonew($id)    {
        $descricao = Yii::$app->request->post("descricao");
        $date = Yii::$app->request->post("date");
        $situacao = Yii::$app->request->post("situacao");
        $id_medico = Yii::$app->request->post("id_medico");
        $id_utente = Yii::$app->request->post("id_utente");
        $climodel= new $this->modelClass;
        $rec= $climodel::find()->where("id=".$id)->one();


        if($rec !== null){
            $rec->descricao=$descricao;
            $rec->date=$date;
            $rec->situacao=$situacao;
            $rec->id_medico=$id_medico;
            $rec->id_utente=$id_utente;
            $rec->save();
            return['SaveError' => 'Ok'];
        }
        throw new NotFoundHttpException(" ID Diagnostico notfound!");



    }
}
