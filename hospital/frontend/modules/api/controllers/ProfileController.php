<?php

namespace frontend\modules\api\controllers;

use Yii;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

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
    public function actionProfiledel($id)
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
    public function actionCprofile()    {
        $id = Yii::$app->request->post("id");
        $First_name = Yii::$app->request->post("First_name");
        $Last_name = Yii::$app->request->post("Last_name");
        $Email = Yii::$app->request->post("Email");
        $Phone_number = Yii::$app->request->post("Phone_number");
        $NIF = Yii::$app->request->post("NIF");
        $Address = Yii::$app->request->post("Address");
        $Birth_date = Yii::$app->request->post("Birth_date");
        $gender = Yii::$app->request->post("gender");
        $postal_code = Yii::$app->request->post("postal_code");
        $climodel= new $this->modelClass;
        $climodel->id=$id;
        $climodel->First_name=$First_name;
        $climodel->Last_name=$Last_name;
        $climodel->Email=$Email;
        $climodel->Phone_number=$Phone_number;
        $climodel->NIF=$NIF;
        $climodel->Address=$Address;
        $climodel->Birth_date=$Birth_date;
        $climodel->gender=$gender;
        $climodel->postal_code=$postal_code;
        $ret = $climodel->save();
        if($ret)
            return 'Saved';
        else
        {
            $err = json_encode( $climodel->getErrors() );
            throw new \yii\web\HttpException(422, $err );
        }
    }
    public function actionProfilenew($id)    {
        $First_name = Yii::$app->request->post("First_name");
        $Last_name = Yii::$app->request->post("Last_name");
        $Email = Yii::$app->request->post("Email");
        $Phone_number = Yii::$app->request->post("Phone_number");
        $NIF = Yii::$app->request->post("NIF");
        $Address = Yii::$app->request->post("Address");
        $Birth_date = Yii::$app->request->post("Birth_date");
        $gender = Yii::$app->request->post("gender");
        $codposta = Yii::$app->request->post("postal_code");
        $imagem =Yii::$app->request->post("image");
        $climodel= new $this->modelClass;
        $rec= $climodel::find()->where("id=".$id)->one();


        if($rec !== null){
            $rec->First_name=$First_name;
            $rec->Last_name=$Last_name;
            $rec->Email=$Email;
            $rec->Phone_number=$Phone_number;
            $rec->NIF=$NIF;
            $rec->Address=$Address;
            $rec->Birth_date=$Birth_date;
            $rec->gender=$gender;
            $rec->postal_code=$codposta;
            $rec->imagem = $imagem;

            $rec->save();
            
            return $rec;
        }
        throw new NotFoundHttpException("Clientid notfound!");



    }



}