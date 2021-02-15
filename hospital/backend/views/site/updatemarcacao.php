<?php

?>

<main class="page registration-page">
    <section class="clean-block clean-form dark">
        <?= $this->render('_formmarcacao', [
            'model' => $model,
            'tempo' => $tempo,
        ]) ?>
    </section>
</main>
