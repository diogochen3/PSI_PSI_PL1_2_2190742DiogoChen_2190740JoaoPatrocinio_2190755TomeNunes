<?php


namespace frontend\mosquitto;



class mqttConfig
{
    public $conn= null;


    /**
     * mqttConfig constructor.
     */
    public function __construct($client = null)
    {
        if(is_null($client)){
            //$client = md5(time());
            $client = uniqid();
        }
        $server = '127.0.0.1';
        $port = 1883;                     // change if necessary // set your password
        $client_id = $client;
        $this->conn = new phpMQTT($server, $port, $client_id);
    }
}
