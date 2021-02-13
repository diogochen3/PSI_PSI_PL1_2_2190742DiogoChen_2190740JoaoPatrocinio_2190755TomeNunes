<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MarcacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Marcacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Aceitar',
            'id_especialidade',
            'id_Utente',
            'id_Medico',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
