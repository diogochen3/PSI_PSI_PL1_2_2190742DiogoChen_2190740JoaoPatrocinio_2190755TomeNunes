<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">




    <main class="page registration-page">
        <section class="clean-block clean-form dark">

                <?= $this->render('_formV', [
                    'model' => $model,
                ]) ?>
        </section>
    </main>

</div>
