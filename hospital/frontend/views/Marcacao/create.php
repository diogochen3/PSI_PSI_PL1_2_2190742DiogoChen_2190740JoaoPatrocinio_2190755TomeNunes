<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $especialidades array */
/* @var $medico array */

$this->title = 'Marcar Consulta';
?>
<div class="marcacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'especialidades' => $especialidades,
        'medico' => $medico,
    ]) ?>

</div>
