<?php

namespace frontend\mosquitto\controllers;

use frontend\mosquitto\mqttConfig;
use frontend\mosquitto\phpMQTT;

class NotificationController
{

    const Notifications_Global = "global_notification";

    const NotificationsTypes_Marcacao = "notification_type_marcacao";

    public static function Send($type, $msg){

        $model = new \stdClass();
        $model->type = $type;
        $model->message = $msg;
        $model->date = date("Y-m-d H:i:s", time());
        $package = json_encode($model);

        $config = new mqttConfig();
        $conn = $config->conn;

        if ($conn->connect(true, NULL)) {
            $conn->publish(NotificationController::Notifications_Global,$package,0, true);
            $conn->close();
            return true;
        }
        return false;
    }

    public static function Receive($client){

        $config = new mqttConfig($client);
        $conn = $config->conn;

        if ($conn->connect(true, NULL)) {

            $package = $conn->subessage(NotificationController::Notifications_Global, 0);

            $conn->close();

            return [$package];
        }

        return [];
    }
}
