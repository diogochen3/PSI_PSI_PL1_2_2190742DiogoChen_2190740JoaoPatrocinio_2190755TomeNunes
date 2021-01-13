<?php

namespace backend\controllers;

use Yii;
use common\models\ReceitasConsultas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceitasConsultasController implements the CRUD actions for ReceitasConsultas model.
 */
class ReceitasConsultasController extends Controller
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
     * Lists all ReceitasConsultas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ReceitasConsultas::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReceitasConsultas model.
     * @param integer $id_receitas
     * @param integer $id_consultas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_receitas, $id_consultas)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_receitas, $id_consultas),
        ]);
    }

    /**
     * Creates a new ReceitasConsultas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    /**
     * Updates an existing ReceitasConsultas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_receitas
     * @param integer $id_consultas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_receitas, $id_consultas)
    {
        $model = $this->findModel($id_receitas, $id_consultas);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_receitas' => $model->id_receitas, 'id_consultas' => $model->id_consultas]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReceitasConsultas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_receitas
     * @param integer $id_consultas
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_receitas, $id_consultas)
    {
        $this->findModel($id_receitas, $id_consultas)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReceitasConsultas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_receitas
     * @param integer $id_consultas
     * @return ReceitasConsultas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_receitas, $id_consultas)
    {
        if (($model = ReceitasConsultas::findOne(['id_receitas' => $id_receitas, 'id_consultas' => $id_consultas])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
