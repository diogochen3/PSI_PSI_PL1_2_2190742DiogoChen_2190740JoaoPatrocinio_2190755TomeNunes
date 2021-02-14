<?php use \yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;
$user =Yii::$app->authManager->getAssignments(Yii::$app->user->getId());
/* @var $utentes array */?>

<ul>

</ul>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>

</head>



<div id="wrapper" style="    margin-top: 2%;">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">

                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Lista de utentes</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        </div>
                        <?php


                   ?>

                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Numero de telefone</th>
                                    <th>Numero de Identificaçao Fiscal</th>
                                    <th>Morada</th>
                                    <th>codigo postal</th>
                                    <th>Data de nascimento</th>
                                    <th>Genero</th>
                                    <?php
                                    if(isset($user['admin'])){
                                    ?><th>Editar</th>
                                        <th>retirar</th> <?php
                                    }
                                    ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    foreach ($utentes as $utente) : ?>

                                    <td></td>
                                    <td><?= $utente->First_name  ?> <?= $utente->Last_name  ?></td>
                                    <td><?= $utente->Email  ?></td>
                                    <td><?= $utente->Phone_number  ?></td>
                                    <td><?= $utente->NIF  ?></td>
                                    <td><?= $utente->Address  ?></td>
                                    <td><?= $utente->postal_code  ?></td>
                                    <td><?= $utente->Birth_date  ?></td>
                                    <td><?= $utente->gender  ?></td>


                                    <?php
                                    if(isset($user['admin'])){
                                        ?><td> <?= Html::a('Update', ['utente/update', 'id' => $utente->id], ['class' => 'btn btn-primary']) ?></td>
                                        <td> <?= Html::a('Retirar', ['utente/delete', 'id' => $utente->id], ['class' => 'btn btn-primary']) ?></td><?php
                                    }
                                    ?>


                                </tr>




                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <?= LinkPager::widget(['pagination' => $pagination]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


