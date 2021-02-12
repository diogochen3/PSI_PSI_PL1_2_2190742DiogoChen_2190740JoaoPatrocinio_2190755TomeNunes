<?php use frontend\mosquitto\phpMQTT;
use \yii\widgets\LinkPager;



?>

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
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Especialização</th>

                                        </tr>
                                    </thead>
                                    <tbody>

  <tr>
      <?php
      foreach ($medicos as $medico) : ?>


      <td><?= $medico->First_name  ?> <?= $medico->Last_name  ?></td>
                                            <td><?= $medico->Email  ?></td>
      <td>
      <?php foreach ($medico->especialidades as $especialidade) {
          ?><?= $especialidade->Name  ?><br>
     <?php } ?>
      </td>


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


