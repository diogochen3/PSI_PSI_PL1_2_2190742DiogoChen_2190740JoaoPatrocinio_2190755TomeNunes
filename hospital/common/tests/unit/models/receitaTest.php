<?php namespace backend\tests;

use common\models\Receitas;

class receitaTest extends \Codeception\Test\Unit
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
        Receitas::deleteAll();
    }
    public static function adicionarReceitas()
    {
        $Receitas = new Receitas();
        $Receitas->id= "9";
        $Receitas->cod_acesso= "213123";
        $Receitas->cod_dispensa= "424242";
        $Receitas->data_emissao= "2021-02-12";
        $Receitas->id_consulta= "1";
        return $Receitas;
    }

    public function testFields()
    {
        $Receitas = $this->adicionarReceitas();
        $this->assertTrue($Receitas->validate());
    }
    public function testAddReceitas()
    {
        $receitas = $this->adicionarReceitas();
        $this->assertTrue($receitas->save());
        $this->tester->seeRecord(Receitas::class, ['cod_dispensa' => '424242']);
    }
    public function testAddErroReceitas()
    {
        $receitas = new Receitas();
        $receitas->id= "ola";
        $receitas->cod_acesso= "ola";
        $receitas->cod_dispensa= "ola";
        $receitas->data_emissao= "ola-02-12";
        $receitas->id_consulta= "ola";

        $this->assertFalse($receitas->save());
        $this->tester->dontSeeRecord(Receitas::class, ['cod_acesso' => 'ola']);

    }
    public function testDeleteReceitas()
    {
        $receitas = $this->adicionarReceitas();
        $receitas->save();
        $this->tester->seeRecord(Receitas::class, ['cod_dispensa' => '424242']);
        $receitas->delete();
        $this->tester->dontSeeRecord(Receitas::class, ['cod_dispensa' => '424242']);

    }

    public function testEditReceitas()
    {

        $receitas = $this->adicionarReceitas();
        $receitas->save();
        $receitas->cod_dispensa = "25";
        $receitas->save();
        $this->tester->seeRecord(Receitas::class, ['cod_dispensa' => '25']);

    }
}





