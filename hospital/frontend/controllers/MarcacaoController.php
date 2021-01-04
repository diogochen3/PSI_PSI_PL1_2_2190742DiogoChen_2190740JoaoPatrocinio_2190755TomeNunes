<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Profile;
use frontend\models\Especialidade;
use frontend\models\MedicoEspecialidade;
use frontend\mosquitto\controllers\NotificationController;
use Yii;
use common\models\Marcacao;
use frontend\models\MarcacaoSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarcacaoController implements the CRUD actions for Marcacao model.
 */
class MarcacaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Marcacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarcacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Marcacao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Marcacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionLists($id){
        $espeuser = MedicoEspecialidade::find()->where(['id_especialidade' => $id])->select('id_medico')->column();
        $profile = Profile::find()
                ->where(['id' => $espeuser])
                ->all();

            if (!empty($profile)) {
                foreach($profile as $item) {
                    echo "<option value='".$item->id."'>".$item->First_name."</option>";
                }
            } else {
                echo "<option>-</option>";
            }

        /*$query =
        $productlist = Especialidade::findBySql('select * from User where "'. $especialidade .'"')->all();


        if(count($productlist)>0){
            foreach ($productlist as $item) {

            }
        }else{

        }*/
    }
    public function actionCreate()
    {
        $model = new Marcacao();

        //VarDumper::dump(Yii::$app->user->can('createMarcacao'));

        if (Yii::$app->user->can('createMarcacao') === true){

        }else{
        $user = Profile::find();
        $medicoId = User::isMedico();
        $medico = $user->where(['id' => $medicoId])->all();
        $esp = Especialidade::find()->all();
        $listEsp = [];
        $listmed = [];

        foreach ($esp as $item) {
            $listEsp[$item->id] = $item->Name;
        }
        foreach ($medico as $item) {
            $listmed[$item->id] = $item->Email;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->id_Utente = Yii::$app->user->id;
            $model->save(false);
            $userl = Profile::find()->where(["id" => Yii::$app->user->id])->one();
            NotificationController::Send(NotificationController::NotificationsTypes_Marcacao, "O Utente ". $userl->First_name ." Fez o pedido de marcação.");

        }



        return $this->render('create', [
            'model' => $model,
            'especialidades' => $listEsp,
            'medico' => $listmed,
        ]);
        }


        return $this->redirect(['../index.php']);
    }

    /**
     * Updates an existing Marcacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Marcacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Marcacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Marcacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marcacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
