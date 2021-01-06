<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>



<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css?h=cbc877e732f00f43eca6ed7bf01bde0b">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css?h=720e42f48318b60f43645907fcf18d00">

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
   /* NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
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
    NavBar::end();*/
    ?>

    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><img src="/assets/img/logo3%20(2).png?h=829630e69395d43245a5df848574b6e5" style="width: 70px;"></div>
                    <div class="sidebar-brand-text mx-3"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">


                    <li class="nav-item">  <?= Html::a('Inicio', ['site/index']) ?></li>
                    <li class="nav-item">  <?= Html::a('Prrrfil', ['site/profile']) ?></li>
                    <li class="nav-item">  <?= Html::a('Lista de Marcaçoes', ['site/table_marcacoes']) ?></li>
                    <li class="nav-item">  <?= Html::a('Lista de Utentes', ['site/table']) ?></li>
                    <li class="nav-item">
                    <?php
                    $user =Yii::$app->authManager->getAssignments(Yii::$app->user->getId());

                    if(isset($user['admin'])){
                        ?><li class="nav-item">  <?= Html::a('Lista de medicos', ['site/table_utentes']);?><?php
                        ?><li class="nav-item"> <?= Html::a('Definições', ['site/table_utentes']);?><?php
                    }


                    ?>
                    </li>
                </ul>

                <style>
                    a{
                        color:black;
                    }
                </style>

            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <div class="input-group-append"></div>
                    </div>
                </form>
                <ul class="nav navbar-nav flex-nowrap ml-auto">
                    <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                        <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto navbar-search w-100">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                    <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span id="notification-counter" class="badge badge-danger badge-counter">0</span><i class="fas fa-bell fa-fw"></i></a>
                            <div id="notifications" class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                <h6 class="dropdown-header">alerts center</h6>

                            </div>
                        </div>
                    </li>

                    <div class="d-none d-sm-block topbar-divider"></div>
                    <li class="nav-item dropdown no-arrow">


                        <div class="nav-item dropdown no-arrow">

                            <?php



                            if (Yii::$app->user->isGuest) {
                                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                            } else {
                                $menuItems[] = '<div class="testarmenu">'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout teste']
                                    )
                                    . Html::endForm()
                                    . '</div>';
                            }
                            echo Nav::widget([
                                'options' => ['class' => 'navbar-nav navbar-right'],
                                'items' => $menuItems,
                            ]);


                            ?>






                            <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
            <script src="/assets/js/script.min.js?h=823eb1733a0a81fa385a52d2e8e60900"></script>
            <script type="text/javascript">
                var limiter = 500;
                var request = function (){
                    if(limiter > 500){
                    $.ajax({
                        url: "/index.php/site/notifications",
                    })
                        .done(function( data ) {
                            var res = data.split("|||");
                            $("#notifications").children("a").remove()
                            $("#notifications").append(res[0])
                            $("#notification-counter").text(res[1])
                        });
                        limiter = 0;
                    }
                    limiter++;
                    window.requestAnimationFrame(request);
                }

                request();
            </script>

</body>
</html>
<?php $this->endPage() ?>
