<?php

namespace frontend\modules\api\controllers;


use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends ActiveController
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
            'class' => QueryParamAuth::className(),
           /* 'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']*/
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /*public function auth($username, $password)
    {
        $user = \common\models\User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
    }*/

}
