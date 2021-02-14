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
        Consultas::deleteAll();
    }
    public static function adicionarConsulta()
    {
        $Consultas = new Consultas();
        $Consultas->id="3";
        $Consultas->estado= "1";
        $Consultas->id_medico= "64";
        $Consultas->id_utente= "43";
        return $Consultas;
    }
    public function testFields()
    {
        $Consultas = $this->adicionarConsulta();
        $this->assertTrue($Consultas->validate());

    }
    public function testAddConsulta()
    {
        $Consultas = $this->adicionarConsulta();
        $this->assertTrue($Consultas->save());
        $this->tester->seeRecord(Consultas::class, ['id' => '3']);
    }
    public function testAddErroConsulta()
    {
        $Consultas = new Consultas();
        $Consultas->id="ola";
        $Consultas->estado= "1";
        $Consultas->id_medico= "64";
        $Consultas->id_utente= "43";

        $this->assertFalse($Consultas->save());
        $this->tester->dontSeeRecord(Consultas::class, ['id' => 'ola']);

    }
    public function testDeleteConsulta()
    {
        $Consultas = $this->adicionarConsulta();
        $Consultas->save();
        $this->tester->seeRecord(Consultas::class, ['id' => '3']);
        $Consultas->delete();
        $this->tester->dontSeeRecord(Consultas::class, ['id' => '3']);

    }

    public function testEditConsulta()
    {

        $Consultas = $this->adicionarConsulta();
        $Consultas->save();
        $Consultas->estado= "0";
        $Consultas->save();
        $this->tester->seeRecord(Consultas::class, ['estado' => '0']);

    }
}