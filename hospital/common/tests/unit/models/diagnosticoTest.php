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
        Diagnostico::deleteAll();
    }
    public static function adicionarDiagnostico()
    {
        $Diagnostico = new Diagnostico();
        $Diagnostico->id="10";
        $Diagnostico->descricao= "testar a descricao";
        $Diagnostico->date= "2021-01-01";
        $Diagnostico->situacao= "testar a situaçao";
        $Diagnostico->id_medico= "64";
        $Diagnostico->id_utente= "43";
        return $Diagnostico;
    }
    public function testFields()
    {
        $Diagnostico = $this->adicionarDiagnostico();
        $this->assertTrue($Diagnostico->validate());

    }
    public function testAddDiagnostico()
    {
        $Diagnostico = $this->adicionarDiagnostico();
        $this->assertTrue($Diagnostico->save());
        $this->tester->seeRecord(Diagnostico::class, ['situacao' => 'testar a situaçao']);
    }
    public function testAddErroDiagnostico()
    {
        $Diagnostico = new Diagnostico();
        $Diagnostico->id= "10";
        $Diagnostico->descricao= "testar a descricao";
        $Diagnostico->date= "testar data";
        $Diagnostico->situacao= "testar a situaçao";
        $Diagnostico->id_medico= "64";
        $Diagnostico->id_utente= "teste do erro";

        $this->assertFalse($Diagnostico->save());
        $this->tester->dontSeeRecord(Diagnostico::class, ['id' => '10']);

    }
    public function testDeleteDiagnostico()
    {
        $diagnostico = $this->adicionarDiagnostico();
        $diagnostico->save();
        $this->tester->seeRecord(Diagnostico::class, ['id' => '10']);
        $diagnostico->delete();
        $this->tester->dontSeeRecord(Diagnostico::class, ['id' => '10']);

    }

    public function testEditDiagnostico()
    {

        $diagnostico = $this->adicionarDiagnostico();
        $diagnostico->save();
        $diagnostico->situacao= "testar a situaçao editada";
        $diagnostico->save();
        $this->tester->seeRecord(Diagnostico::class, ['situacao' => 'testar a situaçao editada']);

    }
}