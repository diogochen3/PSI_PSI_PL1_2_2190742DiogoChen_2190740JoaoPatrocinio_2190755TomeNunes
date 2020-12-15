<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedicoEspecialidade */

$this->title = 'Create Medico Especialidade';
$this->params['breadcrumbs'][] = ['label' => 'Medico Especialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medico-especialidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
