<?php namespace frontend\tests;

use common\models\Marcacao;
use Faker\Guesser\Name;

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
        /*Marcacao::deleteAll();*/
    }
    public static function adicionarMarcacao()
    {
        $marcacao = new Marcacao();
        $marcacao->id= "2";
        $marcacao->Aceitar= "0";
        $marcacao->id_especialidade= "2";
        $marcacao->id_Utente= "42";
        $marcacao->id_Medico= "56";
        return $marcacao;
    }
    public function testFields()
    {
        $marcacao = $this->adicionarMarcacao();
        $this->assertTrue($marcacao->validate());

    }
    public function testAddMarcacao()
    {
        $marcacao = $this->adicionarMarcacao();
        $this->assertTrue($marcacao->save());
        $this->tester->seeRecord(Marcacao::class, ['id' => '2']);
    }
    public function testAddErroMarcacao()
    {
        $marcacao = new Marcacao();
        $marcacao->id= "ola";
        $marcacao->Aceitar= "0";
        $marcacao->id_especialidade= "2";
        $marcacao->id_Utente= "43";
        $marcacao->id_Medico= "64";

        $this->assertFalse($marcacao->save());
        $this->tester->dontSeeRecord(Marcacao::class, ['id' => 'ola']);

    }
    public function testDeleteMarcacao()
    {
      $marcacao = $this->adicionarMarcacao();
        $marcacao->save();
        $this->tester->seeRecord(Marcacao::class, ['id' => '2']);
        $marcacao->delete();
        $this->tester->dontSeeRecord(Marcacao::class, ['id' => '2']);

    }

    public function testEditMarcacao()
    {

        $marcacao = $this->adicionarMarcacao();
        $marcacao->save();
        $marcacao->id_Medico = "53";
        $marcacao->save();
        $this->tester->seeRecord(Marcacao::class, ['id_Medico' => '53']);

    }
}