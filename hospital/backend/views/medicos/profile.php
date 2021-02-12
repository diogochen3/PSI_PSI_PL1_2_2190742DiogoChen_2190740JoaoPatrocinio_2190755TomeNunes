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
                                <?= "Primeiro Nome: ".$model->First_name; ?>
                            </div>
                            <div class="col">
                                <?= "Apelido: ".$model->Last_name; ?>
                            </div>
                            <div class="col">
                                <?= "Email: ".$model->Email; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">

                                <?= "Endereço: ".$model->Address; ?>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col">

                                <?= "codigo_postal: ".$model->postal_code; ?>
                            </div>
                            <div class="col">
                                <?= "Número de Telefone: ".$model->Phone_number; ?>
                            </div>

                            <div class="col">
                                <?= "N.º Identificação Fiscal".$model->NIF; ?>
                            </div>
                            <div class="col">
                                <?= "genero: ".$model->gender; ?>
                            </div>
                            <div class="col">
                                <?= "Data de Nascimento".$model->Birth_date; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <?php foreach ($model->especialidades as $especialidade) {?>
                            <div class="col">
                                <?= "Especialidade: ".$especialidade->Name; ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <?= Html::a('Update',['update', 'id' => $model->id ], ['class' => 'btn btn-success']) ?>
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