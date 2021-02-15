<?php
namespace backend\controllers;


use backend\models\profileSearch;
use backend\models\SignupForm;
use common\models\Consultas;
use common\models\Contacto;
use common\models\Especialidade;
use common\models\Horario;
use common\models\Marcacao;
use common\models\Profile;
use common\models\User;
use frontend\mosquitto\controllers\NotificationController;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
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


    /**
     * Login action.
     *
     * @return string
     */

    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect("index.php/medicos/profile");
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
            $idutente = User::isUtente();

            $query = Profile::find()->where(['id' => $idutente]);


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
        $idmedico = User::isMedico();
        $query = Profile::find()->where(["id" => $idmedico]);

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
    public function actionAceitar($id)
    {

        $marcacao = Marcacao::find()->where(["id" => $id])->one();

        $marcacao->Aceitar = 1;
        $marcacao->save(false);
        $consulta = new Consultas();
        $consulta->id = $marcacao->id;
        $consulta->id_medico = Yii::$app->user->getId();
        $consulta->id_utente = $marcacao->id_Utente;
        $consulta->estado = 0;
        $consulta->save();
        return $this->redirect("table_marcacoes");
    }

    public function actionNaceitar($id)
    {
        $marcacao = Marcacao::find()->where(["id" => $id])->one();

        $marcacao->Aceitar = 0;
        $marcacao->save(false);

        return $this->redirect("table_marcacoes");
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
                    case NotificationController::NotificationsTypes_Marcacao: $link = "index.php/site/table_marcacoes"; break;
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
            $esp = Especialidade::find()->all();
            $listEsp = [];

            foreach ($esp as $item) {
                $listEsp[$item->id] = $item->Name;
            }


            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');

                return $this->goHome();
            }
            return $this->render('signup', [
                'model' => $model,
                'especialidades' => $listEsp,
            ]);
    }



    public function actionEnviar($id)
    {
        $model = new Horario();

        if ($model->load(Yii::$app->request->post()) && $model->enviar($id)) {
            Yii::$app->session->setFlash('success', 'enviado com sucesso');
            return $this->goHome();
        }

        return $this->render('enviar', [
            'model' => $model,
        ]);
    }

    public function actionMensagem()
    {
        $model = Contacto::find()->all();
        return $this->render('mensagem', [
            'model' => $model,
        ]);
    }
    public function actionUpdatemarcacao($id)
    {
        $model = Marcacao::find()->where(["id"=>$id])->one();
        $horario1 = Horario::find()->where(["id_medico"=>$model->id_Medico])->all();
        $horario = Horario::find()->where(["id"=>$id])->one();

        $listhora = [];


        foreach ($horario1 as $item) {
            if ($item->usado == 0){
                $listhora[$item->id] = $item->tempo;
            }

        }



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $horarionovo=Horario::find()->where(['id'=>$model->id])->one();
            $horarionovo->usado=1;
            $horario->usado = 0;

            $horario->save(false);
            $horarionovo->save(false);


            return $this->redirect(['table_marcacoes']);
        } return $this->render('updatemarcacao', [
        'model' => $model,
        'tempo' => $listhora,
    ]);
    }
        }