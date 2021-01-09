<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReceitasConsultas */

$this->title = 'Create Receitas Consultas';
$this->params['breadcrumbs'][] = ['label' => 'Receitas Consultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receitas-consultas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
