<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Especialidade */

$this->title = 'Create Especialidade';
$this->params['breadcrumbs'][] = ['label' => 'Especialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especialidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
