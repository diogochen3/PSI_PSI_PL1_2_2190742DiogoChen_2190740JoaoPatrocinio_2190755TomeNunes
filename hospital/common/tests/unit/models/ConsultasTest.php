<?php namespace common\tests;

use common\models\Consultas;

class ConsultasTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testConsultas(){
        $consultas = new Consultas();
        $consultas->id = "1";
        $consultas->id_medico= "2";
        $consultas->id_utente= "3";
        $consultas->save();


        $this->tester->seeRecord('common\models\Diagnostico', ['id' => '1',
            'id_medico' => '1',
            'id_utente' => '1']);

        // $this->tester->dontSeeRecord('common\models\profile', ['First_name' => 'pato','Last_name' => 'ganso' ,'NIF' => '220032320','Address' => 'rua dos patos','Email' => 'pato.ganso@gmail.com','Phone_number' => '923456344','postal_code' => '2440','Birth_date' => '2000-01-04','gender' => 'Male']);

    }
}