<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */


$this->title = 'Diagnostico';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultas-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
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

                                        <td><?= $item->id0->Diagnosticos0->date  ?></td>
                                        <td><?= $item->id0->Diagnosticos0->descricao  ?></td>
                                        <td><?= $item->id0->Diagnosticos0->situacao  ?></td>
                                        <td><?= $item->id0->Diagnosticos0->medico->First_name  ?> <?= $item->id0->Diagnosticos0->medico->Last_name  ?></td>

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
