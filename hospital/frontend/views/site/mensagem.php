<?php

/* @var $this yii\web\View */
/* @var $utente */
use common\models\User;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$this->title = 'Health Schedule';

?>

<body>

<!-- End: Fixed navbar starting with transparency -->
<main class="page">
    <section class="clean-block features">
        <div class="container">
            <div class="block-heading"></div>
        </div>
        <h2 class="text-info" style="border-width: 0px;margin: 25px;padding: 0px;height: 37px;">Mensagens</h2>
        <div class="col-sm-6 col-lg-4" style="margin: 0px;">
            <div class="card-body info" style="margin: 5px;padding: 30px;height: 90px;">
                <h4 class="card-title"> <?= $utente->First_name; ?> <?= $utente->Last_name; ?></h4>
            </div>
        </div>
        </div>
        <div class="table-responsive" style="margin: 16px;height: 150px;padding: 15px;">
            <table class="table">
                <thead>
                <tr>
                                    <th></th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Assunto</th>
                                    <th>Corpo</th>
                                    <th>Data de Envio</th>
                                    <th>Data de Respondido</th>
                                    <th>Responder</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    foreach ($model as $contacto) : ?>

                                        <td></td>
                                        <td><?= $contacto->categoria->Categoria  ?></td>
                                        <td><?= $contacto->nome  ?></td>
                                        <td><?= $contacto->email  ?></td>
                                        <td><?= $contacto->assunto  ?></td>
                                        <td><?= $contacto->corpo  ?></td>
                                        <td><?= $contacto->data_envio  ?></td>
                                        <?php if ($contacto->respondido){ ?>
                                            <td><?= $contacto->data_respondido  ?></td>
                                        <?php }else{ ?>
                                            <td></td>
                                        <?php } ?>
                                        <?php if ($contacto->respondido == 0){ ?>
                                            <td>Não foi respondido </td>
                                        <?php }elseif($contacto->respondio == 1){ ?>
                                            <td>Respondeu</td>
                                        <?php } ?>


                                    <?php endforeach; ?>

                                </tr>
                                </tbody>
            </table>
        </div>
    </section>
</main>