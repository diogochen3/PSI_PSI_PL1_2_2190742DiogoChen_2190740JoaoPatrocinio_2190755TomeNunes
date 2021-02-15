
<div class="marcacao-form">

    <?php use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList($tempo
    )->label("tempo"); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>