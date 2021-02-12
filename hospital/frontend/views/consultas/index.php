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
                    <th>receita</th>
                </tr>
                </thead>
                <tbody>
                <?php if (sizeof($model) > 0 ){ ?>

                    <?php foreach ($model as $item) {?>

                        <tr>
                            <td><?= $item->id0->id0->tempo  ?></td>
                            <td><?= $item->medico->First_name; ?> <?= $item->medico->Last_name; ?></td>
                            <td><?= $item->id0->especialidade->Name; ?></td>
                        <td><?php if(sizeof($item->receitas) > 0) { ?></td>
                            <td> <?= Html::a('receita', ['receitas/view',"id" =>$item->id], ['class' => 'btn btn-primary']); ?> </td>
                        <?php } else { ?>
                            <td></td> <?php }
                                }  ?>
                        </tr>
                    <?php } else { ?>
                    <td> <?= "nao aconteceu nehuma consulta"; ?></td>
                <?php }?>
                </tbody>
            </table>
        </div>
    </section>
</main>