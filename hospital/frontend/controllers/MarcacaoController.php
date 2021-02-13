<?php

namespace frontend\controllers;

use common\models\Especialidade;
use common\models\Horario;
use common\models\MedicoEspecialidade;
use common\models\User;
use common\models\Profile;
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
                echo "<option>Não existe ainda pessoas com esta especialidade</option>";
            }

        /*$query =
        $productlist = Especialidade::findBySql('select * from User where "'. $especialidade .'"')->all();


        if(count($productlist)>0){
            foreach ($productlist as $item) {

            }
        }else{

        }*/
    }

    public function actionListdate($id){
        $horario = Horario::find()->where(['id_medico' => $id])->all();

        if (!empty($horario)) {
            foreach($horario as $item) {
                if ($item->usado == 0)
                    echo "<option value='".$item->id."'>".$item->tempo."</option>";
            }

        } else {
            echo "<option>Está indisponivel</option>";
        }

    }


    public function actionCreate()
    {
        $model = new Marcacao();

        //VarDumper::dump(Yii::$app->user->can('createMarcacao'));

        if (Yii::$app->user->can('createMarcacao')){
            $idUtilizador =  Yii::$app->user->id;
            $user = Profile::find();
            $medicoId = User::isMedico();
            $medico = $user->where(['id' => $medicoId])->all();
            $esp = Especialidade::find()->all();
            $userl = Profile::find()->where(["id" => $idUtilizador])->one();
            $listEsp = [];
            $listmed = [];

            foreach ($esp as $item) {
                $listEsp[$item->id] = $item->Name;
            }

            foreach ($medico as $item) {
                $listmed[$item->id] = $item->First_name;
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->id_Utente = Yii::$app->user->id;
                $horario = Horario::find()->where(["id" => $model->id])->one();
                if ($horario->usado == 0)
                {
                    $horario->usado = 1;
                    $horario->save(false);
                    $model->save(false);

                    $marcacao = Marcacao::find();
                    $marcacaoutente = $marcacao->where(['id_Utente' => $idUtilizador])->all();
                    return $this->render('historico', [
                        'model' => $marcacaoutente,
                        'utente' => $userl,
                    ]);
                    NotificationController::Send(NotificationController::NotificationsTypes_Marcacao, "O Utente ". $userl->Last_name ."  (" . $userl->NIF .") Fez o pedido de marcação.");
                }

        }

        return $this->render('create', [
            'model' => $model,
            'especialidades' => $listEsp,
            'medico' => $listmed,
        ]);
        }else {
            return $this->redirect(['../index.php']);
        }


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
        $model = Marcacao::find()->where(["id"=>$id])->one();
        $horario = Horario::find()->where(["id"=>$id])->one();


        $listhora = [];

        foreach ($horario as $item) {
            $listhora[$item->id] = $item->tempo;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $horario->usado = 0;
            $horario->save(false);
            return $this->redirect(['historico']);
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

        return $this->redirect(['historico']);
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

    public function actionHistorico()
    {

        $utenteId =  Yii::$app->user->id;
        $marcacao = Marcacao::find();

        if(Yii::$app->request->get() == null){
            $marcacaoutente = $marcacao->where(['id_Utente' => $utenteId])->all();

        }else{
            $Nomemedico = Yii::$app->request->get();
            $medico = Profile::find();
            $medico->where(['First_name' => $Nomemedico])->one();
            var_export($medico);
            die;
            $marcacaoutente = $marcacao->where(['id_Utente' => $utenteId])->andWhere(['id_Medico' => $medico])->all();

        }

              $utente = Profile::find();
        $utente = $utente->where(['id'=> $utenteId])->one();
        return $this->render('historico', [
            'model' => $marcacaoutente,
            'utente' => $utente,


        ]);
    }

    public function actionMensagem($id)
    {
        $horario = Horario::find()->where(["id_marcacao"])->all();

        return $this->render('mensagem', [
            'model' => $horario,
        ]);
    }
    /* Book::find()
    ->where(['between', 'date', $start, $end])
    ->andWhere(['like', 'book', $bookName])
    ->all();*/
}
