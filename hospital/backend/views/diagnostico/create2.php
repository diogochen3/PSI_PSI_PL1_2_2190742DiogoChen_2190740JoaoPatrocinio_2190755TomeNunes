<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Diagnostico */
/* @var $utente common\models\Diagnostico */

$this->title = 'Create Diagnostico';

?>
<div class="diagnostico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
