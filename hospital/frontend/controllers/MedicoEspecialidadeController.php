<?php

namespace frontend\controllers;

use Yii;
use app\models\MedicoEspecialidade;
use app\models\MedicoEspecialidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedicoespecialidadeController implements the CRUD actions for MedicoEspecialidade model.
 */
class MedicoEspecialidadeController extends Controller
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
     * Lists all MedicoEspecialidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicoEspecialidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MedicoEspecialidade model.
     * @param integer $id_medico
     * @param integer $id_especialidade
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_medico, $id_especialidade)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_medico, $id_especialidade),
        ]);
    }

    /**
     * Creates a new MedicoEspecialidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedicoEspecialidade();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_medico' => $model->id_medico, 'id_especialidade' => $model->id_especialidade]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MedicoEspecialidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_medico
     * @param integer $id_especialidade
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_medico, $id_especialidade)
    {
        $model = $this->findModel($id_medico, $id_especialidade);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_medico' => $model->id_medico, 'id_especialidade' => $model->id_especialidade]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MedicoEspecialidade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_medico
     * @param integer $id_especialidade
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_medico, $id_especialidade)
    {
        $this->findModel($id_medico, $id_especialidade)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MedicoEspecialidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_medico
     * @param integer $id_especialidade
     * @return MedicoEspecialidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_medico, $id_especialidade)
    {
        if (($model = MedicoEspecialidade::findOne(['id_medico' => $id_medico, 'id_especialidade' => $id_especialidade])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
