<?php

/* @var $this yii\web\View */

use common\models\User;
use yii\helpers\VarDumper;

$this->title = 'Health Schedule';


/*$ids = User::find()->select('id')->column();
var_dump($ids);
$user = User::isMedico();
var_dump($user);*/
/*foreach ($user as $item) {
 if ($item == )
}*/

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
            <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="/assets/img/avatars/avatar1.jpg?h=2bf47f2c2deaed837d2490a2db0a7175">
                <div class="card-body info" style="margin: 5px;padding: 30px;height: 90px;">
                    <h4 class="card-title"> <?= $model[0]->utente->id0->First_name; ?></h4>
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
                </tr>
                </thead>
                <tbody>
                <?php foreach ($model as $item) {?>
                <tr>
                    <td><?= $item->date; ?></td>
                    <td><?= $item->medico->id0->First_name; ?></td>
                    <td><?= $item->especialidade->Name; ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>