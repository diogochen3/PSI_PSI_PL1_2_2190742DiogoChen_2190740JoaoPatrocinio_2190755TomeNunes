<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="block-heading">
    <h2 class="text-info" style="width: 159px;margin: 4px;padding: 10px;height: 54px;">Perfil</h2>
</div>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="col">
    <div class="form-group"> <?= $form->field($model, 'imagem')->fileInput() ?></div>
</div>
<div class="form-row">

    <div class="col-xl-4">
        <div class="form-group"><?= $form->field($model, 'First_name')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="col-xl-4">
        <div class="form-group"><?= $form->field($model, 'Last_name')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="col">
        <div class="form-group"><?= $form->field($model, 'Address')->textarea(['maxlength' => true]) ?></div>
    </div>
</div>

<div class="form-row">
    <div class="col-xl-9">
        <div class="form-group"><?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="col">
        <div class="form-group"><?= $form->field($model, 'Phone_number')->textInput() ?></div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
