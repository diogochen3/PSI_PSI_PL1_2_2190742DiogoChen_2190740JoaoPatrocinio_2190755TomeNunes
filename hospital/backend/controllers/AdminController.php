<?php


namespace backend\controllers;


use common\models\Marcacao;
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

}