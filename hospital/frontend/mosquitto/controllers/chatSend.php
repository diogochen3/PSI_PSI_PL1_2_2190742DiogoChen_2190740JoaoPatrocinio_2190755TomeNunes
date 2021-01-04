<?php

namespace frontend\mosquitto\controllers;
require("..\mqttConfig.php");
require("..\phpMQTT.php");
use frontend\mosquitto\mqttConfig;
use frontend\mosquitto\phpMQTT;

$config = new mqttConfig("TESTE1");
$conn = $config->conn;
if ($conn->connect(true, NULL)) {
    $msg = readline("Write a message:  ");
    $conn->publish('global_chat',$msg,0, true);
    $conn->close();
} else {
    echo "Time out!\n";
}