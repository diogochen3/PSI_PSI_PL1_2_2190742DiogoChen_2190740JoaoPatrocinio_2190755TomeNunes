<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */



?>
<div class="consultas-index">


    <div id="wrapper" style="    margin-top: 2%;">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">

                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Lista de Receitas</p>
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
                                        <th>Nome do medico</th>
                                        <th>Código Acesso</th>
                                        <th>Código Dispensa</th>
                                        <th>medicamentos</th>
                                        <th>Data emissão</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($model as $item) : ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $item->consulta->medico->First_name." ".$item->consulta->medico->Last_name ?> </td>
                                            <td><?= $item->cod_acesso  ?> </td>
                                            <td> <?= $item->cod_dispensa ?></td>
                                            <td>
                                                <?php foreach ($item->receitaMedicamentos as $receitaMedicamento) { ?>
                                                    Nome do Medicamento: <?= $receitaMedicamento->medicamento->nome_medicamento; ?><br>
                                                    Dosagem: <?=  $receitaMedicamento->medicamento->dosagem;  ?><br>
                                                    Forma:  <?=  $receitaMedicamento->medicamento->forma_farmaceuta;  ?><br>
                                                    Embalagem: <?=  $receitaMedicamento->medicamento->embalagem;  ?><br>
                                                    Quantidade: <?=  $receitaMedicamento->quantidade;  ?><br>
                                                    Posologia: <?=  $receitaMedicamento->posologia;  ?><br>
                                                    Codigo Otico:  <?=  $receitaMedicamento->medicamento->CodigoOtico; ?><br>
                                                    ____________________
                                                    <br>
                                                <?php } ?>
                                            </td>
                                            <td><?= $item->data_emissao  ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
