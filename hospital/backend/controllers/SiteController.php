<?php
namespace backend\controllers;


use backend\models\profileSearch;
use backend\models\SignupForm;
use common\models\Marcacao;
use common\models\Profile;
use frontend\mosquitto\controllers\NotificationController;
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
                        'roles' => ['medico','admin'],


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

        if ($model->load(Yii::$app->request->post()) && $model->validateLogin() && $model->login()) {


            return $this->goHome();
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

        return $this->redirect('login');
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


            $searchModel = new profileSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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
                'pagination' => $pagination,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
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

    public function actionTable_medicos(){
        $query = Profile::find()->where("is_medico = 1");


        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $medicos = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('table_medicos', [
            'medicos' => $medicos,
            'pagination' => $pagination
        ]);

    }
        public function actionNotifications(){

            $list = NotificationController::Receive("user_".Yii::$app->user->id);

            $html = '<a class="d-flex align-items-center dropdown-item" href="[[LINK]]"><div class="mr-3">
                     <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                     </div><div><span class="small text-gray-500">[[DATE]]</span>
                     <p>[[MESSAGE]]</p></div></a>';

            $result = "";
            $count = 0;
            $array = [];

            foreach ($list as $item){

                $decode = json_decode($item);

                $link = "/";
                switch ($decode->type){
                    case NotificationController::NotificationsTypes_Marcacao: $link = "/site/table_marcacoes"; break;
                }
                $content = str_replace("[[LINK]]", $link,str_replace("[[DATE]]", $decode->date,str_replace("[[MESSAGE]]", $decode->message,$html)));
                $array[strtotime($decode->date)] = $content;
                $count++;
            }

            krsort($array);

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return implode("",$array) . "|||" . $count;
        }
        public function actionSignup()
        {
            $model = new SignupForm();
            VarDumper::dump($model->NIF);
            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();
            }
            return $this->render('signup', [
                'model' => $model,
                ]);
    }
}
