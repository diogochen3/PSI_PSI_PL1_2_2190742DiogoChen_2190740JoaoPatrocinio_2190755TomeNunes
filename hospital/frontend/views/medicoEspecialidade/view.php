<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MedicoEspecialidade */

$this->title = $model->id_medico;
$this->params['breadcrumbs'][] = ['label' => 'Medico Especialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medico-especialidade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_medico' => $model->id_medico, 'id_especialidade' => $model->id_especialidade], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_medico' => $model->id_medico, 'id_especialidade' => $model->id_especialidade], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_medico',
            'id_especialidade',
        ],
    ]) ?>

</div>
