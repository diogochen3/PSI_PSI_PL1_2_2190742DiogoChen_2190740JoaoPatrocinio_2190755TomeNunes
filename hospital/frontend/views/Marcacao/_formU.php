<?php

use common\models\Profile;
use frontend\models\MedicoEspecialidade;
use PhpMqtt\Client\MQTTClient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
/* @var $especialidades array */
/* @var $medico array */

?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList($tempo
    )->label("tempo"); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>