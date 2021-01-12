<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\profile */
/* @var $form yii\widgets\ActiveForm */


?>


        <div class="container-fluid">
            <h3 class="text-dark mb-4">Perfil</h3>

                <div class="col-lg-8">
                    <div class="row mb-3 d-none">
                        <div class="col">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">definições do perfil</p>
                                </div>
                                <div class="card-body">



                                    <?php $form = ActiveForm::begin(); ?>







                                        <div class="form-row">
                                            <div class="col">
                                                <?= $form->field($model, 'First_name')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col">
                                                <?= $form->field($model, 'Last_name')->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    <div class="form-row">
                                    <div class="col">

                                        <?= $form->field($model, 'Address')->textarea(['maxlength' => true]) ?>
                                    </div>

                                    </div>

                                        <div class="form-row">
                                            <div class="col">

                                                <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col">
                                                <?= $form->field($model, 'Phone_number')->textInput() ?>
                                            </div>



                                        </div>
                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="/assets/js/script.min.js?h=823eb1733a0a81fa385a52d2e8e60900"></script>
</body>