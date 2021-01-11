<?php namespace backend\tests;

use common\models\Diagnostico;

class diagnosticoTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testDiagnostico(){

        $Diagnostico = new Diagnostico();
        $Diagnostico->descricao= "testar a descricao";
        $Diagnostico->date= "2021-01-01";
        $Diagnostico->situacao= "testar a situaçao";
        $Diagnostico->id_medico= "1";
        $Diagnostico->id_utente= "1";
        $Diagnostico->save();


        $this->tester->seeRecord('common\models\Diagnostico', ['descricao' => 'testar a descricao',
            'date' => '2021-01-01' ,
            'situacao' => 'testar a situaçao',
            'id_medico' => '1',
            'id_utente' => '1']);

        // $this->tester->dontSeeRecord('common\models\profile', ['First_name' => 'pato','Last_name' => 'ganso' ,'NIF' => '220032320','Address' => 'rua dos patos','Email' => 'pato.ganso@gmail.com','Phone_number' => '923456344','postal_code' => '2440','Birth_date' => '2000-01-04','gender' => 'Male']);

    }
}