<?php

namespace frontend\mosquitto\controllers;
require("..\mqttConfig.php");
require("..\phpMQTT.php");

use frontend\mosquitto\mqttConfig;
use frontend\mosquitto\phpMQTT;

$config = new mqttConfig("TESTE0");
$conn = $config->conn;
if(!$conn->connect(true, NULL)) {
    exit(1);
}
$topics['global_notification'] = array('qos' => 0, 'function' => function($topic, $msg){
    //$msg = readline("Write a message:  ");
    echo "\t$msg\n\n";
});

$conn->subscribe($topics, 0);
while($conn->proc()) {

}


$conn->close();
