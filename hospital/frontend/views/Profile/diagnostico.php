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
                            <p class="text-primary m-0 font-weight-bold">Corpo Clinico</p>
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
                                        <th>Data do Diagnostico</th>
                                        <th>Descrição</th>
                                        <th>Situação</th>
                                        <th>Nome do medico</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                        foreach ($model as $item) : ?>

                                        <td><?= $item->date  ?></td>
                                        <td><?= $item->descricao  ?></td>
                                        <td><?= $item->situacao  ?></td>
                                        <td><?= $item->medico->First_name  ?> <?= $item->medico->Last_name  ?></td>

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
