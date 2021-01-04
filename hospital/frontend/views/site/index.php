<?php

/* @var $this yii\web\View */

use common\models\User;
use frontend\mosquitto\phpMQTT;
use PhpMqtt\Client\MQTTClient;



$server = 'localhost';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'phpMQTT-subscriber'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = true;
$topics['bluerhinos/phpMQTT/examples/publishtest'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

while($mqtt->proc()) {


}

$mqtt->close();

function procMsg($topic, $msg){
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}




?>



<main class="page landing-page">
    <section class="clean-block clean-hero" style="background-image: url(&quot;assets/img/tech/image4.jpg&quot;);border-color: rgba(9,162,255,0.85);color: rgba(9, 162, 255, 0.85);">
        <div class="text" style="width: 50%;"><img src="assets/img/tech/logo3.png"></div>
    </section>
    <section class="clean-block features">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-left text-info float-left" data-aos="fade-right" data-aos-once="true" style="width: 50%;">Bem-Vindo</h2><a class="text-right float-right" data-aos="fade-left" data-aos-once="true" href="#" style="width: 50%;text-decoration: none;/*position: relative;*//*top: 5%;*//*left: 5%;*/"><strong>MARCAÇÃO ONLINE</strong><i class="fa fa-arrow-right" style="position: relative;left: 2%;"></i><br></a>
            </div>
        </div>
    </section>
    <div data-aos="fade-up" data-aos-once="true" class="row justify-content-center">
        <div class="col-md-5 feature-box"><i class="icon-clock icon"></i>
            <h4><strong>ATENDIMENTO PERMANENTE</strong><br></h4>
            <p><strong>Mais do que um hospital, somos uma casa que o recebe, que partilha as suas preocupações e que o apoia sempre da melhor forma. Tratamos afetivamente!</strong><br></p>
        </div>
        <div class="col-md-5 feature-box"><i class="icon-pencil icon"></i>
            <h4><strong>MARCAÇÃO ONLINE</strong><br></h4>
            <p><strong>Para sua comodidade, pode efetuar um pedido de marcação online, sujeito a confirmação pelos nossos serviços no prazo de 48 horas.</strong><br></p>
        </div>
        <div class="col-md-5 feature-box"><i class="icon-screen-smartphone icon"></i>
            <h4><strong>ÚLTIMAS TECNOLOGIAS</strong><br></h4>
            <p><strong>Somos uma unidade moderna dotada de equipamentos tecnológicos avançados para lhe proporcionar qualidade, conforto, rigor e segurança.</strong><br></p>
        </div>
        <div class="col-md-5 feature-box"><i class="icon-refresh icon"></i>
            <h4><strong>CORPO CLÍNICO QUALIFICADO</strong><br></h4>
            <p><strong>Colocamos à sua disposição uma equipa de profissionais altamente qualificados nas mais diversas especialidades médicas e cirúrgicas.</strong><br></p>
        </div>
    </div>
    <section class="clean-block clean-info dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info" data-aos="fade-up" data-aos-once="true">Novidades</h2>
            </div>
            <div class="row justify-content-center" data-aos="fade-up" data-aos-once="true">
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/scenery/no-img.png">
                        <div class="card-body info" style="padding: 28px;height: 172px;">
                            <h4 class="card-title"><strong>Novo médico - Cirurgia Plástica Reconstrutiva e Estética</strong></h4><button class="btn border-pretty" data-bs-hover-animate="pulse" style="color: rgba(9,162,255,0.85);border-color: rgba(9,162,255,0.85);margin-bottom: auto;margin-left: auto;margin-top: auto;margin-right: auto;" type="button">Continue Reading <i class="icon ion-android-arrow-forward"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/scenery/no-img.png">
                        <div class="card-body info">
                            <h4 class="card-title"><strong>RECRUTAMENTO - AUXILIAR DE SAÚDE</strong><br></h4><button class="btn border-pretty" data-bs-hover-animate="pulse" style="color: rgba(9,162,255,0.85);" type="button">Continue Reading <i class="icon ion-android-arrow-forward"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/scenery/no-img.png">
                        <div class="card-body info">
                            <h4 class="card-title"><strong>CUIDADOS COM AS TEMPRATURAS ELEVADAS</strong><br></h4><button class="btn border-pretty" data-bs-hover-animate="pulse" style="color: rgba(9,162,255,0.85);border-color: rgba(9,162,255,0.85);margin-bottom: auto;margin-right: auto;margin-top: auto;margin-left: auto;" type="button">Continue Reading <i class="icon ion-android-arrow-forward"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="block-heading" style="height: 20%;width: 100%;"></div>
</main>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="assets/js/smoothproducts.min.js"></script>
<script src="assets/js/theme.js"></script>
<script src="assets/js/Fixed-navbar-starting-with-transparency.js"></script>
