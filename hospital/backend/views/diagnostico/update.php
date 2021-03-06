<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Diagnostico */

$this->title = 'Update Diagnostico: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Diagnosticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diagnostico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'utente' => $utente,
    ]) ?>

</div>
