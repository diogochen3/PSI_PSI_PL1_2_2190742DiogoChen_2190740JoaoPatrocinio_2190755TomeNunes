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
        $marcacao->date= "2020-10-10";
        $marcacao->tempo= "23:26:00";
        $marcacao->Aceitar= "0";
        $marcacao->id_especialidade= "1";
        $marcacao->id_Utente= "18";
        $marcacao->id_Medico= "14";
        $marcacao->save();

        $this->tester->seeRecord('common\models\marcacao', ['date' => '2020-10-10', 'tempo' => '23:26:00' , 'Aceitar' => '0', 'id_especialidade' => '1', 'id_Utente' => '18', 'id_Medico' => '14']);

        $this->tester->dontSeeRecord('common\models\marcacao', ['date' => '2020-10-12', 'tempo' => '23:26:01' , 'Aceitar' => '1', 'id_especialidade' => '2', 'id_Utente' => '18', 'id_Medico' => '14']);

    }

}