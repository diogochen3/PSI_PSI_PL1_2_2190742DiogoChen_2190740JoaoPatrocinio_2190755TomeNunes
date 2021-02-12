<?php

namespace backend\controllers;

use backend\models\ReceitaForm;
use common\models\Consultas;
use common\models\Medicamento;
use common\models\ReceitaMedicamento;
use Yii;
use common\models\Receitas;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceitasController implements the CRUD actions for Receitas model.
 */
class ReceitasController extends Controller
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
     * Lists all Receitas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $idutilizador = Yii::$app->user->getId();
        $consultas = Consultas::find()->where(["id_medico"=>$idutilizador])->all();
        foreach ($consultas as $consulta) {
           $ids = $consulta->id;
        }
        $model = Receitas::find()->where(["id_consulta" => $ids])->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Receitas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Receitas::find()->where(["id_consulta" => $id])->all();
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new Receitas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ReceitaForm();
        $medicamentos =  Medicamento::find()->all();
        $listMedicamento = [];

        foreach ($medicamentos as $item) {
            $listMedicamento[$item->id] = "Nome: ".$item->nome_medicamento." Dosagem: " .$item->dosagem.
                " Forma do farmaceuta: " .$item->forma_farmaceuta.
                " Embalado: ".$item->embalagem;
        }

        if ($model->load(Yii::$app->request->post()) && $model->enviar($id)) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model,
            'medicamentos' => $listMedicamento
        ]);
    }

    public function actionAdicionar($id)
    {
        $model = new ReceitaMedicamento();
        //$model = ReceitaMedicamento::find()->where(["id_receita" => $id])->one();

        $model->id_receita = $id;
        $medicamentos =  Medicamento::find()->all();
        $listMedicamento = [];

        foreach ($medicamentos as $item) {
            $listMedicamento[$item->id] = "Nome: ".$item->nome_medicamento." Dosagem: " .$item->dosagem.
                " Forma do farmaceuta: " .$item->forma_farmaceuta.
                " Embalado: ".$item->embalagem;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_receita]);
        }

        return $this->render('adicionar', [
            'model' => $model,
            'medicamentos' => $listMedicamento
        ]);
    }


    /**
     * Updates an existing Receitas model.
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
     * Deletes an existing Receitas model.
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
     * Finds the Receitas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Receitas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Receitas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
