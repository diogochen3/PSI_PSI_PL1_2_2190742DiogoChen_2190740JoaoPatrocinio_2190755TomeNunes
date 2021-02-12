<?php use \yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $contactos array */?>

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

                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                            <table class="table my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Assunto</th>
                                    <th>Corpo</th>
                                    <th>Utente contactado</th>
                                    <th>Data de Envio</th>
                                    <th>Data de Respondido</th>
                                    <th>Responder</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($model as $contacto) : ?>
                                <tr>


                                        <td></td>
                                        <td><?= $contacto->categoria->Categoria  ?></td>
                                        <td><?= $contacto->nome  ?></td>
                                        <td><?= $contacto->email  ?></td>
                                        <td><?= $contacto->assunto  ?></td>
                                        <td><?= $contacto->corpo  ?></td>
                                        <td><?= $contacto->utente->First_name." ".$contacto->utente->Last_name ?></td>
                                        <td><?= $contacto->data_envio ?></td>
                                        <?php if ($contacto->respondido){ ?>
                                            <td><?= $contacto->data_respondido  ?></td>
                                        <?php }else{ ?>
                                            <td></td>
                                        <?php } ?>
                                        <?php if ($contacto->respondido == 0){ ?>
                                            <td><?= Html::a('Reponder',['responder',"id" => $contacto->id],['class' => 'btn btn-primary']); ?></td>
                                        <?php }elseif($contacto->respondido == 1){ ?>
                                            <td>Respondeu</td>
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
