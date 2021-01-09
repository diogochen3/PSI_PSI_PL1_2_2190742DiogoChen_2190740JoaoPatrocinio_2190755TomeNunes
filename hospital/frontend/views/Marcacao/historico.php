<?php

/* @var $this yii\web\View */

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
        <h2 class="text-info" style="border-width: 0px;margin: 25px;padding: 0px;height: 37px;">Histórico de Consultas do Utente</h2>
        <div class="col-sm-6 col-lg-4" style="margin: 0px;">
                           <div class="card-body info" style="margin: 5px;padding: 30px;height: 90px;">
                    <h4 class="card-title"> <?= $model[0]->utente->id0->First_name; ?> <?= $model[0]->utente->id0->Last_name; ?></h4>
                </div>
            </div>
        </div>
        <div class="table-responsive" style="margin: 16px;height: 150px;padding: 15px;">
            <table class="table">
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Médico</th>
                    <th>Especialidade</th>
                    <th>Aceito</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $item) {?>
                <tr>
                    <td><?= $item->date; ?></td>
                    <td><?= $item->medico->id0->First_name; ?> <?= $item->medico->id0->Last_name; ?></td>
                    <td><?= $item->especialidade->Name; ?></td>
                    <?php if ($item->Aceitar == 0) { ?>
                        <td> <?= Html::a('Não foi aceite', ['update', 'id' => $item->id], ['class' => 'btn btn-primary']) ?></td>
                    <?php }elseif($item->Aceitar == 1){  ?>
                    <td><?= "Aceite" ?></td>
                    <?php }else{ ?>
                    <td><?= "Ainda não foi visto" ?></td>
                    <?php } ?>
                    <td><?= Html::a('Delete', ['delete', 'id' => $item->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?></td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </section>
</main>