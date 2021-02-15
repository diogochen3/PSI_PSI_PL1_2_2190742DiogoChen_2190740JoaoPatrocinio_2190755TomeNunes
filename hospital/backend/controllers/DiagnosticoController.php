<?php

namespace backend\controllers;

use common\models\Profile;
use common\models\User;
use Yii;
use common\models\Diagnostico;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiagnosticoController implements the CRUD actions for Diagnostico model.
 */
class DiagnosticoController extends Controller
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
     * Lists all Diagnostico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $idUtilidor = Yii::$app->user->id;
        $diagnostico = Diagnostico::find()->where(["id_medico" => $idUtilidor])->all();

        return $this->render('index', [
            'model' => $diagnostico,
        ]);
    }

    /**
     * Displays a single Diagnostico model.
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
     * Creates a new Diagnostico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Diagnostico();
        $user = Profile::find();
        $idUtente = User::isUtente();
        $utente = [];
        $arrayUtente = $user->where(['id' => $idUtente])->all();
        foreach ($arrayUtente as $item) {
            $utente[$item->id] = $item->First_name;
        }

            if ($model->load(Yii::$app->request->post())) {
                $model->id_medico = Yii::$app->user->id;
                $model->save(false);
                return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
            'utente' => $utente
        ]);
    }

    public function actionCreate2($id,$date)
    {
        $model = new Diagnostico();
        $model->id_medico = Yii::$app->user->id;
        $model->id_utente = $id;
        $model->date = $date;
        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);
            return $this->redirect('index');
        }

        return $this->render('create2', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Diagnostico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $utente= Profile::find()->where(['id'=>$model->id_utente])->all();

        $listute =[];
        foreach ($utente as $item) {
            $listute[$item->id] = $item->First_name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
            'utente'=>$listute,
        ]);
    }

    /**
     * Deletes an existing Diagnostico model.
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
     * Finds the Diagnostico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Diagnostico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Diagnostico::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
