<?php

namespace frontend\controllers;

use Yii;
use app\models\Especialidade;
use app\models\EspecialidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EspecialidadeController implements the CRUD actions for Especialidade model.
 */
class EspecialidadeController extends Controller
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
     * Lists all Especialidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EspecialidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Especialidade model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->ShowByRole();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Especialidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Especialidade();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Especialidade model.
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
     * Deletes an existing Especialidade model.
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
     * Finds the Especialidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Especialidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function ShowByRole(){
        $role = (new \yii\db\Query())
            ->select('user_id')
            ->from('auth_assignment')
            ->where(['item_name' => 'medico'])
            ->all();

        foreach ($role as $medico_id){
            $role2 = (new \yii\db\Query())
                ->select('*')
                ->from('profile')
                ->where(['id' => $medico_id])
                ->all();

            var_dump($role2);
        }
        return $role;
    }






    protected function findModel($id)
    {
        if (($model = Especialidade::findOne($id)) !== null) {
            return $model;
        }





        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
