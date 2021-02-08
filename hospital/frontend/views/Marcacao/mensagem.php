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
        <h2 class="text-info" style="border-width: 0px;margin: 25px;padding: 0px;height: 37px;">Mensagem</h2>
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
                    <th>Medico</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($model as $item) :?>
                        <td><?= $item->marcacao->medico->First_name; ?> <?= $item->medico->Last_name; ?></td>
                        <td><?= Yii::$app->formatter->asDate($item->tempo, 'php:Y-m-d H:m:s') ?></td>
                    <?php endforeach; ?>
                </tr>

                </tbody>
            </table>
        </div>
    </section>
</main>