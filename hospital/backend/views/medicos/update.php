<?php

use yii\helpers\Html;

?>


<main class="page registration-page">
    <section class="clean-block clean-form dark">
            <?= $this->render('_formU', [
                'model' => $model,
            ]) ?>
    </section>
</main>
