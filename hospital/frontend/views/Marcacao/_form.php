<?php

use common\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
/* @var $especialidades array */
/* @var $medico array */
?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->Input("date") ?>

    <?= $form->field($model, 'tempo')->Input("time") ?>


<?= $form->field($model, 'id_especialidade')->dropDownList($especialidades,
    ['prompt'=>'-Choose a especialidade-',
        'onchange'=>'
        	$.post( "'.Yii::$app->urlManager->createUrl('marcacao/lists?id=').'"+$(this).val(), function( data ) {
			  $( "select#Marcacao-id_medico" ).html( data );
				  			});'
    ]);

$dataPost=ArrayHelper::map(Profile::find()->all(), 'id', 'First_name');
echo $form->field($model, 'id_Medico')
    ->dropDownList(
        $dataPost,
        ['prompt'=>'-Choose o medico-']
    );?>

    <?= $form->field($model, 'id_Medico')->dropDownList(
        $medico

    )->label("Especialidade");?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
