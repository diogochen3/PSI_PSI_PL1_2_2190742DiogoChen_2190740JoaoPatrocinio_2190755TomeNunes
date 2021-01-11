<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Receitas */

$this->title = 'Create Receitas';
?>
<div class="receitas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
