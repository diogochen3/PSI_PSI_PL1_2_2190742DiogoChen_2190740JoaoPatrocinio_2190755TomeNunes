<?php


namespace backend\controllers;


use common\models\Consultas;
use common\models\Marcacao;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

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

}