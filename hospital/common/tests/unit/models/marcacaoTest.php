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

        $marcacao->date= "sadasdwad";
        $this->assertFalse($marcacao->date);
        $marcacao->date = "1654741";
        $this->assertFalse($marcacao->date);
        $marcacao->date= null;
        $this->assertFalse($marcacao->date);

        $marcacao->tempo= "asddsawqe";
        $this->assertFalse($marcacao->tempo);
        $marcacao->tempo= "32412312";
        $this->assertFalse($marcacao->tempo);
        $marcacao->tempo= null;
        $this->assertFalse($marcacao->tempo);

        $marcacao->Aceitar= "asdqwe";
        $this->assertFalse($marcacao->Aceitar);
        $marcacao->Aceitar= "986899";
        $this->assertFalse($marcacao->Aceitar);
        $marcacao->Aceitar= null;
        $this->assertFalse($marcacao->Aceitar);


        $marcacao->id_especialidade= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->id_especialidade);
        $marcacao->id_especialidade= "aeqwe";
        $this->assertFalse($marcacao->id_especialidade);
        $marcacao->id_especialidade= null;
        $this->assertFalse($marcacao->id_especialidade);


        $marcacao->id_Utente= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->id_Utente);
        $marcacao->id_Utente= "aeqwe";
        $this->assertFalse($marcacao->id_Utente);
        $marcacao->id_Utente= null;
        $this->assertFalse($marcacao->id_Utente);


        $marcacao->id_Medico= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->id_Medico);
        $marcacao->id_Medico= "aeqwe";
        $this->assertFalse($marcacao->id_Medico);
        $marcacao->id_Medico= null;
        $this->assertFalse($marcacao->id_Medico);

        $this->assertFalse($marcacao->save());

        /*$this->tester->seeRecord('common\models\marcacao', ['date' => '2020-10-10', 'tempo' => '23:26:00' , 'Aceitar' => '0', 'id_especialidade' => '1', 'id_Utente' => '18', 'id_Medico' => '14']);

        $this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'tempo' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']);
*/
    }

    public function testCriarMarcacao(){

        $marcacao = new Marcacao();

        $marcacao->date= "2021-02-24";
        $this->assertTrue($marcacao->date);

        $marcacao->tempo= "20:10:00";
        $this->assertTrue($marcacao->tempo);

        $marcacao->Aceitar= "0";
        $this->assertTrue($marcacao->Aceitar);

        $marcacao->id_especialidade= "1";
        $this->assertTrue($marcacao->id_especialidade);

        $marcacao->id_Utente= "45";
        $this->assertFalse($marcacao->id_Utente);

        $marcacao->id_especialidade= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->id_Utente);
        $marcacao->id_especialidade= "aeqwe";
        $this->assertFalse($marcacao->id_Medico);
        $marcacao->id_especialidade= "999999999999999999999999999999999999999999999999999";
        $this->assertFalse($marcacao->id_Medico);
        $this->assertFalse($marcacao->save());

        /*$this->tester->seeRecord('common\models\marcacao', ['date' => '2020-10-10', 'tempo' => '23:26:00' , 'Aceitar' => '0', 'id_especialidade' => '1', 'id_Utente' => '18', 'id_Medico' => '14']);

        $this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'tempo' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']);
*/
    }

}