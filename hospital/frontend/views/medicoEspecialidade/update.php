<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedicoEspecialidade */

$this->title = 'Update Medico Especialidade: ' . $model->id_medico;
$this->params['breadcrumbs'][] = ['label' => 'Medico Especialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_medico, 'url' => ['view', 'id_medico' => $model->id_medico, 'id_especialidade' => $model->id_especialidade]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medico-especialidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
