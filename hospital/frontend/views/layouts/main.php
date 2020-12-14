<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\BootstrapWidgetTrait;
use yii\bootstrap\Dropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css?h=e6119be3d1e93121c763c07412516b02">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css?h=fcf418ef9ef80599aec4b7aead34e9eb">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>'Health Schedule',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-light navbar-expand-md fixed-top bg-light navbar-transparency',
            'style' => 'height: 80px',
        ],
    ]);

    $menuItems = [

        ['label' => 'Inicio', 'url' => ['/site/index']],
        ['label' => 'Serviços', 'url' => ['/site/about']],
        ['label' => 'Corpo Clinico', 'url' => ['/site/about']],
        ['label' => 'Marcações', 'url' => ['/consultas/create']],


    ];
    if (Yii::$app->user->isGuest) {

        $menuItems[] =   ['label' => 'Registar', 'url' => ['/site/signup']];
        $menuItems[] =    ['label' => 'Entrar', 'url' => ['/site/login']];



    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


    <div class="row" style="background-color: rgb(41,44,47); margin-right: 0;">
        <div class="col-sm-6 col-md-4 footer-navigation">
            <h3 style="color: blue">Health Schedule</h3>
            <p class="company-name " style="     margin-left: 50px; margin-top: 25%;">Health schedule © 2020</p>
        </div>
        <div class="col-sm-6 col-md-4 footer-contacts">
            <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                <p style="color: #ffffff;"><span class="new-line-span">Algures em</span> Leiria, Portugal</p>
            </div>
            <div><i class="fa fa-phone footer-contacts-icon"></i>
                <p class="footer-center-info email text-left" style="color: #ffffff;"> +1 555 123456</p>
            </div>
            <div><i class="fa fa-envelope footer-contacts-icon"></i>
                <p style="color: #ffffff;"> <a href="#" target="_blank">hospital@hospital.com</a></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4 footer-about">
            <h4 style="color: #ffffff;">Sobre</h4>
            <p style="color: #ffffff;"><strong>O&nbsp;</strong>Health schedule&nbsp;<strong>é uma unidade vocacionada para a prestação de cuidados de saúde. Temos ao seu dispor uma ampla oferta de serviços nas várias especialidades médicas e cirúrgicas.</strong><br><strong>Contando com profissionais de excelência e infra-estruturas equipadas, o Hospital tem como objetivo prestar um eficaz tratamento aos seus pacientes.</strong><br></p>
            <div
                    class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
