<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */


$this->title = 'Consultas';
?>
<div class="consultas-index">

    <div id="wrapper" style="    margin-top: 2%;">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">

                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Lista de Consultas</p>
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
                                        <th>Data da Consulta</th>
                                        <th>Nome do utente</th>
                                        <th>Realizar consulta</th>
                                        <th>Fazer diagnostico</th>
                                        <th>Enviar receita</th>
                                        <th>Ver Receitas enviados</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                        foreach ($model as $item) : ?>

                                        <td></td>
                                        <td><?= $item->id0->id0->tempo ?></td>
                                        <td><?= $item->utente->First_name  ?> <?= $item->utente->Last_name  ?></td>
                                        <?php if ($item->estado == 0){ ?>
                                            <td><?= Html::a('Realizar consulta',['realizar', 'id' => $item->id], ['class' => 'btn btn-primary']); ?> </td>
                                        <?php }else{ ?>
                                        <td>Realiazado</td>
                                        <?php } ?>
                                        <?php if ($item->estado == 0){ ?>
                                        <td></td>
                                        <?php }elseif ($item->estado == 1 && sizeof($item->utente->diagnosticos0) <= 0){ ?>
                                            <td><?= Html::a('Criar o diagnostico',['diagnostico/create2', 'id' => $item->id_utente,'date' =>$item->id0->id0->tempo], ['class' => 'btn btn-primary']); ?> </td>
                                        <?php }else{ ?>
                                            <td>Foi Realizado o diagnostico</td>
                                        <?php } ?>
                                        <?php if ($item->estado == 1){ ?>
                                            <td><?= Html::a('Enviar', ['receitas/create', 'id' => $item->id], ['class' => 'btn btn-primary']) ?> </td>
                                        <?php }else{ ?>
                                            <td></td>
                                        <?php } ?>
                                        <?php if (sizeof($item->receitas) > 0 ){  ?>
                                        <td><?= Html::a('Ver receitas', ['receitas/view', 'id' => $item->id], ['class' => 'btn btn-primary']) ?> </td>
                                        <?php }else{ ?>
                                        <td></td>
                                        <?php } ?>
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
