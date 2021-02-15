<?php


namespace backend\controllers;


use common\models\Consultas;
use common\models\Diagnostico;
use common\models\Horario;
use common\models\Marcacao;
use common\models\Medicamento;
use common\models\Profile;
use common\models\ReceitaMedicamento;
use common\models\Receitas;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AdminController extends Controller
{

    public function actionLista_marcacao()
    {
        $query = Marcacao::find();


        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $marcacoes = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('lista_marcacao', [
            'marcacoes' => $marcacoes,
            'pagination' => $pagination
        ]);
    }
    public function actionLista_consultas()
    {

        $model = Consultas::find()->all();

        return $this->render('lista_consultas', [
            'model' => $model,
        ]);

    }
    public function actionLista_diagnostico()
    {

        $model = Diagnostico::find()->all();

        return $this->render('lista_diagnostico', [
            'model' => $model,
        ]);

    }
    public function actionLista_receitas()
    {

        $model = Receitas::find()->all();

        return $this->render('lista_receitas', [
            'model' => $model,
        ]);

    }
    public function actionUpdatediagnostico($id)
    {
        $model = $this->findModeldiagnostico($id);
        $utente= Profile::find()->where(['id'=>$model->id_utente])->all();

        $listute =[];
        foreach ($utente as $item) {
            $listute[$item->id] = $item->First_name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('updatediagnostico', [
            'model' => $model,
            'utente'=>$listute,
        ]);
    }
    public function actionDeletediagnostico($id)
    {
        $this->findModeldiagnostico($id)->delete();

        return $this->redirect(['diagnostico/index']);
    }
    protected function findModeldiagnostico($id)
    {
        if (($model = Diagnostico::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
        return $this->redirect("lista_marcacao");
    }

    public function actionNAceitar($id)
    {
        $marcacao = Marcacao::find()->where(["id" => $id])->one();
        $marcacao->aceitar = 0;
        $marcacao->save(false);

        return $this->redirect("lista_marcacao");
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
    public function actionView($id)
    {
        $model = Receitas::find()->where(["id_consulta" => $id])->all();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDeletemarcacao($id)
    {
        $this->findModelmarcacao($id)->delete();
        $horario=Horario::find()->where(['id'=>$id])->one();
        $horario->usado=0;
        $horario->save(false);

        return $this->redirect(['index']);
    }
    protected function findModelmarcacao($id)
    {
        if (($model = Marcacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdatereceitas($id)
    {
        $model = $this->findModelreceitas($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('updatereceitas', [
            'model' => $model,
        ]);
    }
    protected function findModelreceitas($id)
    {
        if (($model = Receitas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDelete($id)
    {
        $this->findModelreceitas($id)->delete();

        return $this->redirect(['index']);
    }
}


