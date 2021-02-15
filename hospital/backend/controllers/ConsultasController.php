<?php

namespace backend\controllers;

use common\models\ReceitasConsultas;
use Yii;
use common\models\Consultas;
use backend\models\ConsultasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConsultasController implements the CRUD actions for Consultas model.
 */
class ConsultasController extends Controller
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
     * Lists all Consultas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $medicoId =  Yii::$app->user->id;
        $model = Consultas::find()->where(['id_medico'=>$medicoId])->all();

        return $this->render('index', [
            'model' => $model,
        ]);

    }

    public function actionCreate($id)
    {
        $model = new ReceitasConsultas();
        $receitaConsultas = ReceitasConsultas::find()->all();
        $listRec = [];
        foreach ($receitaConsultas as $item) {
            $listRec[$item->Receitas->id] = $item->Receitas->Name;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_receitas' => $model->id_receitas, 'id_consultas' => $model->id_consultas]);
        }

        return $this->render('create', [
            'model' => $model,
            'receitas' => $listRec,
            'id' => $id
        ]);
    }

    /**
     * Displays a single Consultas model.
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
     * Creates a new Consultas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Updates an existing Consultas model.
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
     * Deletes an existing Consultas model.
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
     * Finds the Consultas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Consultas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Consultas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRealizar($id)
    {
        $consulta = Consultas::find()->where(["id" => $id])->one();
        $consulta->estado = 1;
        $consulta->save();

        $model = Consultas::find()->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
