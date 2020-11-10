<?php


namespace common\models;


class Calculadora
{

    public function somar($val1,$val2){
        return $val1 + $val2;
    }
    public function subtrair($val1,$val2){
        return $val1 - $val2;
    }
    public function dividir($val1,$val2){
        return $val1 / $val2;
    }
    public function multiplicar($val1,$val2){
        return $val1 * $val2;
    }
}