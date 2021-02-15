<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */


$this->title = 'Consultas';
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
                            <p class="text-primary m-0 font-weight-bold">Lista de Dignostico</p>
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
                                        <th></th>
                                        <th>Data da Diagnostico</th>
                                        <th>Descricão</th>
                                        <th>Nome do utente</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                        foreach ($model as $item) : ?>

                                        <td></td>
                                        <td><?= $item->date ?></td>
                                        <td><?= $item->descricao  ?> </td>
                                        <td><?= $item->utente->First_name  ?> <?= $item->utente->Last_name  ?></td>
                                        <td><?= Html::a('editar', ['update', 'id' => $item->id],['class' => 'btn btn-success']) ?></td>
                                        <td><?= Html::a('eliminar', ['delete', 'id' => $item->id], [
                                                'class' => 'btn btn-danger',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?></td>
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
