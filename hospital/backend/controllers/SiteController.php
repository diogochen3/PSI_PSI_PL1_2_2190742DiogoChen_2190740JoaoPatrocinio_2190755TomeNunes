<?php
namespace backend\controllers;


use common\models\Marcacao;
use common\models\Profile;
use Yii;
use yii\data\Pagination;
use yii\debug\models\search\User;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,


                    ],

                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,

                    ],




                    [
                        'allow' => true,
                        'roles' => ['medico','admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public static function isUserAdmin($email)

    {



    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionProfile()
    {

        $model = $this->findModel(Yii::$app->user->getId());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('profile');
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTable()

        {
            $query = Profile::find()->where(['is_medico' => 0]);


            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query->count()
            ]);

            $utentes = $query->orderBy('First_name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();


            return $this->render('table', [
                'utentes' => $utentes,
                'pagination' => $pagination
            ]);

        }
        public function actionTable_marcacoes(){
            $id= Yii::$app->user->getId();
            $query = Marcacao::find()->where("id_Medico = ". $id);


            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $query->count()
            ]);

            $marcacoes = $query->orderBy('id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('table_marcacoes', [
                'marcacoes' => $marcacoes,
                'pagination' => $pagination
            ]);

        }

}
