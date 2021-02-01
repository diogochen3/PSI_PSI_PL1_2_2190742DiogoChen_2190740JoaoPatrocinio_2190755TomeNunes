<?php

namespace frontend\modules\api\controllers;



use frontend\modules\api\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class UserController extends ActiveController
{

    public $modelClass = 'frontend\modules\api\models\User';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function auth($email, $password)
    {
        $user = User::findByEmail($email);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
    }

    public function actionLogin()
    {
        $climodel= new$this->modelClass;
        $email= Yii::$app->request->post("Email");
        $pass= Yii::$app->request->post("Password");
        $ret= $climodel::find()->where(["Email" => $email])->one();

       if ($ret->validatePassword($pass) && $ret !== null)

            return ["id" =>$ret->id];
        else
        {
            $err = json_encode( $climodel->getErrors() );
            throw new \yii\web\HttpException(422, $err );
        }
    }
}
