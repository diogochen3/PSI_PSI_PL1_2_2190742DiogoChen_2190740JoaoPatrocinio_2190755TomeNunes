<?php

namespace frontend\modules\api\controllers;

use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;


class MarcacaoController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Marcacao';
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

    public function actionMarcardel($id)
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
    public function actionMarcar()    {
        $date= Yii::$app->request->post("date");
        $tempo= Yii::$app->request->post("tempo");
        $especialidade = Yii::$app->request->post("id_especialidade");
        $aceitar = Yii::$app->request->post("Aceitar");
        $medico = Yii::$app->request->post("id_Medico");
        $utente = Yii::$app->request->post("id_Utente");
        $climodel= new $this->modelClass;
        $climodel->date=$date;
        $climodel->tempo=$tempo;
        $climodel->id_especialidade=$especialidade;
        $climodel->id_Utente=$utente;
        $climodel->Aceitar=$aceitar;
        $climodel->id_Medico=$medico;
        $ret = $climodel->save();
        if($ret)
            return 'Saved';
        else
        {
            $err = json_encode( $climodel->getErrors() );
            throw new \yii\web\HttpException(422, $err );
        }
    }
    public function actionMarcacaonew($id)    {
        $date = Yii::$app->request->post("date");
        $tempo = Yii::$app->request->post("tempo");
        $especialidade = Yii::$app->request->post("id_especialidade");
        $aceitar = Yii::$app->request->post("Aceitar");
        $medico = Yii::$app->request->post("id_Medico");
        $utente = Yii::$app->request->post("id_Utente");
        $climodel= new $this->modelClass;
        $rec= $climodel::find()->where("id=".$id)->one();


        if($rec !== null){
                $rec->date=$date;
                $rec->tempo=$tempo;
                $rec->id_especialidade=$especialidade;
                $rec->id_Utente=$utente;
                $rec->Aceitar=$aceitar;
                $rec->id_Medico=$medico;
                $rec->save();
                return['SaveError' => 'Ok'];
    }
        throw new NotFoundHttpException("Clientid notfound!");



    }



}
