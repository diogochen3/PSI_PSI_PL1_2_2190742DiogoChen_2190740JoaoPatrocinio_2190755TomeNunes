<?php

/* @var $this yii\web\View */
/* @var $utente */
use yii\helpers\VarDumper;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MarcacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
                    <th>Tempo disponivel</th>
                    <th>Médico</th>
                    <th>usado</th>
                </tr>
                </thead>
                <tbody>



                    <?php
                    foreach ($model as $item) {?>
                        <tr>
                            <td><?= $item->tempo; ?></td>
                            <td><?= $item->medico->First_name; ?> <?= $item->medico->Last_name; ?></td>

                            <?php if($item->usado = 0){
                            ?>
                                <td style="color: red">Horario indisponivel</td>
                                <?php

                            }else{

                                ?>
                                <td style="color: green">Horario disponivel</td>
                                <?php

                            }
                            ?>

                        </tr>

                <?php }?>


                </tbody>
            </table>
        </div>
    </section>
</main>