<?php

/* @var $this yii\web\View */

use common\models\User;

$this->title = 'Health Schedule';

$ids = User::find()->select('id')->column();
var_dump($ids);
$user = User::isMedico();
var_dump($user);
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
                    <h4 class="card-title">John Smith</h4>
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
                <tr>
                    <td>Cell 1</td>
                    <td>Cell 2</td>
                    <td>Cell 2</td>
                </tr>
                <tr>
                    <td>Cell 3</td>
                    <td>Cell 2</td>
                    <td>Cell 4</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>