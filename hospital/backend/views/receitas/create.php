<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Receitas */
/* @var $medicamentos array */
$this->title = 'Create Receitas';
$this->params['breadcrumbs'][] = ['label' => 'Receitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receitas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'medicamentos'=>$medicamentos,
    ]) ?>

</div>
