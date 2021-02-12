<?php

use common\models\Profile;
use frontend\models\MedicoEspecialidade;
use PhpMqtt\Client\MQTTClient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Marcacao */
/* @var $form yii\widgets\ActiveForm */
/* @var $especialidades array */
/* @var $medico array */

?>

<div class="marcacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_especialidade')->dropDownList($especialidades,
        ['prompt'=>'-Escolhe a especialidade-',
            'onchange'=>
                '$.get( "'.Url::toRoute('/marcacao/lists').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'id_Medico').'" ).html( data );
                            }
                        );
                    '
        ])->label("Especialidade");?>

    <?= $form->field($model, 'id_Medico')
        ->dropDownList($medico[]= [],
            ['prompt'=>'-Escolhe o medico-',
                'onchange'=>
                '$.get( "'.Url::toRoute('/marcacao/listdate').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'id').'" ).html( data );
                            }
                        );
                    '
            ]
        )->label("Medico"); ?>


    <?= $form->field($model, 'id')->dropDownList(
        ['prompt'=>'-Escolhe o data-']
    )->label("tempo"); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
