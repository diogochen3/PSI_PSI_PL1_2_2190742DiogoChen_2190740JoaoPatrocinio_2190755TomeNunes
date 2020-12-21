<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MarcacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="marcacao-index">


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
            'date',
            'tempo',
            'Aceitar',
            'id_especialidade',
            //'id_Utente',
            //'id_Medico',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
