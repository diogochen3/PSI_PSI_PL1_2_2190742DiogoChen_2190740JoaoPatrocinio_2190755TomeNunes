<?php namespace common\tests;

use common\models\Pessoa;

class pessoaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    function testnome()
    {
        $pessoa = new Pessoa();

        $pessoa->nome = null;
        $this->assertTrue($pessoa->validate(['username']));

        $pessoa->nome = 'toolooooongnaaaaaaameeeq';
        $this->assertTrue($pessoa->validate(['username']));

        $pessoa->nome = 'emi';
        $this->assertTrue($pessoa->validate(['username']));

    }

    function testidade()
    {
        $pessoa = new Pessoa();

        $pessoa->idade = null;
        $this->assertIsInt($pessoa->idade);

        $pessoa->idade = 'toolooooongnaaaaaaameeeq12';
        $this->assertIsInt($pessoa->idade,"nao e numero");

        $pessoa->idade = 10;
        $this->assertIsInt($pessoa->idade,"é numero");

    }
    function testmorada()
    {
        $pessoa = new Pessoa();

        $pessoa->morada = null;
        $this->assertTrue($pessoa->validate(['username']));

        $pessoa->morada = 'toolooooongnaaaaaaameeeq';
        $this->assertTrue($pessoa->validate(['username']));

        $pessoa->morada= 'emi';
        $this->assertTrue($pessoa->validate(['username']));

    }
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
}