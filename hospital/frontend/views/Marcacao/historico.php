<?php

/* @var $this yii\web\View */
/* @var $utente */
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
        <h2 class="text-info" style="border-width: 0px;margin: 25px;padding: 0px;height: 37px;">Histórico de marcações do Utente</h2>
        <div class="col-sm-6 col-lg-4" style="margin: 0px;">
                           <div class="card-body info" style="margin: 5px;padding: 30px;height: 90px;">
                    <h4 class="card-title"> <?= $utente->First_name; ?> <?= $utente->Last_name; ?></h4>
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
                    <th>Editar</th>
                    <th>Canselar</th>
                </tr>
                </thead>
                <tbody>
                <?php if (sizeof($model) > 0 ){ ?>
                <?php foreach ($model as $item) {?>


                <tr>
                    <td><?= $item->id0->tempo ?></td>
                    <td><?= $item->medico->First_name; ?> <?= $item->medico->Last_name; ?></td>
                    <td><?= $item->especialidade->Name; ?></td>
                    <?php if ($item->Aceitar == 0) { ?>
                        <?= 'Não foi aceite'; ?>
                        <td> <?= Html::a('editar', ['update', 'id' => $item->id], ['class' => 'btn btn-primary']) ?></td>
                        <td><?= Html::a('Cancelar', ['delete', 'id' => $item->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?></td>
                    <?php }elseif($item->Aceitar == 1){  ?>
                        <td><?= 'Aceite'; ?></td>
                        <td> </td>
                        <td> </td>
                    <?php }else{ ?>
                    <td><?= "Ainda não foi visto" ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <?php }else         {
                    echo "<td> nao tem marcacao</td>";
                }?>
                </tbody>
            </table>
        </div>
    </section>
</main>