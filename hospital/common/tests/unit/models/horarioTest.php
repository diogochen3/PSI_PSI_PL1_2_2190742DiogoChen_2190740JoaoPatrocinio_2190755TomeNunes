<?php namespace common\tests\models;

use common\models\Horario;

class horarioTest extends \Codeception\Test\Unit
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
       /* Horario::deleteAll();*/
    }
    public static function adicionarHorario()
    {
        $Horario = new Horario();
        $Horario->id="9";
        $Horario->tempo= "2021-02-24 14:24:22";
        $Horario->usado= "0";
        $Horario->id_medico= "64";
        return $Horario;
    }
    public function testFields()
    {
        $Horario = $this->adicionarHorario();
        $this->assertTrue($Horario->validate());

    }
    public function testAddHorario()
    {
        $Horario = $this->adicionarHorario();
        $this->assertTrue($Horario->save());
        $this->tester->seeRecord(Horario::class, ['id' => '9']);
    }
    public function testAddErroHorario()
    {
        $Horario = new Horario();
        $Horario->id="9";
        $Horario->tempo= "2021-02-24 14:24:22";
        $Horario->usado= "0";
        $Horario->id_medico= "ola";

        $this->assertFalse($Horario->save());
        $this->tester->dontSeeRecord(Horario::class, ['id_medico' => 'ola']);

    }
    public function testDeleteHorario()
    {
        $Horario = $this->adicionarHorario();
        $Horario->save();
        $this->tester->seeRecord(Horario::class, ['id' => '9']);
        $Horario->delete();
        $this->tester->dontSeeRecord(Horario::class, ['id' => '9']);

    }

    public function testEditHorario()
    {

        $Horario = $this->adicionarHorario();
        $Horario->save();
        $Horario->usado= "1";
        $Horario->save();
        $this->tester->seeRecord(Horario::class, ['usado' => '1']);

    }
}