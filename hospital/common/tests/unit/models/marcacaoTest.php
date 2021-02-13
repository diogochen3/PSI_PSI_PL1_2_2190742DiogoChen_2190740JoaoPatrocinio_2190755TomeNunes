<?php namespace frontend\tests;

use common\models\Marcacao;

class marcacaoTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
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
    public function testMarcacao(){

        $marcacao = new Marcacao();
/*
        $marcacao->date= "sadasdwad";
        $this->assertFalse($marcacao->validate($marcacao->date));
        $marcacao->date = "1654741";
        $this->assertFalse($marcacao->validate($marcacao->date));
        $marcacao->date= null;
        $this->assertFalse($marcacao->validate($marcacao->date));
*/

        $marcacao->id = "wqeqweqweqweqwe";
       // $this->assertFalse($marcacao->validate($marcacao->id));

        $marcacao->Aceitar= "asdqqwewe";
      //  $this->assertFalse($marcacao->validate($marcacao->Aceitar));
      /*  $marcacao->Aceitar= null;
        $this->assertFalse($marcacao->validate($marcacao->Aceitar));*/


        /*$marcacao->id_especialidade= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->validate($marcacao->id_especialidade));*/
        $marcacao->id_especialidade= "aeqwe";
     //   $this->assertFalse($marcacao->validate($marcacao->id_especialidade));
        /*$marcacao->id_especialidade= null;
        $this->assertFalse($marcacao->validate($marcacao->id_especialidade));*/


       /* $marcacao->id_Utente= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->validate($marcacao->id_Utente));*/
        $marcacao->id_Utente= "aeqwe";
     //   $this->assertFalse($marcacao->validate($marcacao->id_Utente));
       /* $marcacao->id_Utente= null;
        $this->assertFalse($marcacao->validate($marcacao->id_Utente));*/


        $marcacao->id_Medico= "999999999999999999999999999999999999999999999999999";
     //   $this->assertFalse($marcacao->validate($marcacao->id_Medico));
       /* $marcacao->id_Medico= "aeqwe";
        $this->assertFalse($marcacao->validate($marcacao->id_Medico));
        $marcacao->id_Medico= null;
        $this->assertFalse($marcacao->validate($marcacao->id_Medico));*/

        $this->assertFalse($marcacao->save());

        /*$this->tester->seeRecord('common\models\marcacao', ['date' => '2020-10-10', 'id' => '23:26:00' , 'Aceitar' => '0', 'id_especialidade' => '1', 'id_Utente' => '18', 'id_Medico' => '14']));

        $this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'id' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']));
*/
    }

    public function testCriarMarcacao(){

        $marcacao = new Marcacao();

        $marcacao->id= 2;

        $marcacao->Aceitar= 0;

        $marcacao->id_especialidade= 1;

        $marcacao->id_Utente= 39;

        $marcacao->id_Medico = 60;
        $this->assertTrue($marcacao->save());
        $marcacao->save();

        //$this->tester->seeRecord('common\models\marcacao', ['id' => 2 , 'Aceitar' => 0, 'id_especialidade' => 1, 'id_Utente' => 39, 'id_Medico' => 60]);

        /*$this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'id' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']));*/

    }

    public function testVerMarcacao(){

        $this->tester->seeRecord('common\models\marcacao', ['id' => 2 , 'Aceitar' => 0, 'id_especialidade' => 1, 'id_Utente' => 39, 'id_Medico' => 60]);

        /*$this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'id' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']));*/

    }
}