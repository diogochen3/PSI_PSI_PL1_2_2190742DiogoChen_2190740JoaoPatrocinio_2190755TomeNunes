
<?php use yii\helpers\Html;
use \yii\widgets\LinkPager;

/* @var $marcacoes array */?>

<ul>

</ul>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title></title>

</head>



<div id="wrapper" style="    margin-top: 2%;">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">

                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Lista de marcações</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome da especialidade</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php

                                    foreach ($marcacoes as $marcacao) : ?>
                                    <td></td>

                                    <td><?= $marcacao->utente->First_name  ?></td>
                                    <td><?= $marcacao->medico->First_name  ?></td>
                                    <td><?= $marcacao->especialidade->Name  ?></td>
                                    <td><?= $marcacao->id0->tempo  ?></td>
                                </tr>


                                <?php endforeach; ?>
<style>


</style>

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