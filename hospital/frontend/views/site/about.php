<?php

/* @var $this yii\web\View */

use yii\helpers\Html;



$roleModel = Yii::$app->db
    ->createCommand("Select * from auth_assignment where item_name='medico'")
    ->queryAll();
foreach($roleModel as $roda) {

$medico_user = Yii::$app->db
    ->createCommand("Select * from profile where id='". $roda['user_id'] ."'")
    ->queryAll();

foreach($medico_user as $row) {



?>

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
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Especialização</th>
                                            <th>Marcar Consulta</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php


                                  ?>  <tr>
                                            <td><img class="rounded-circle mr-2" width="30" height="30" src="/assets/img/avatars/avatar1.jpeg?h=0ecc82101fb9a10ca459432faa8c0656"><?= $row['First_name']; ?> <?= $row['Last_name']; ?></td>
                                            <td><?= $row['Email']; ?></td>


                                        </tr>
<?php
                                    }
                                    }


?>





                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Nome</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>Especialização</strong></td>
                                            <td><strong>Marcar Consulta</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>


