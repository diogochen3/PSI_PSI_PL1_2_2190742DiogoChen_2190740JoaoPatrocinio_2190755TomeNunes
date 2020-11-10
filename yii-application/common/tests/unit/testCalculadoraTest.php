<?php namespace common\tests;


use Cassandra\Exception\DivideByZeroException;
use common\models\Calculadora;
use mysql_xdevapi\Exception;

class testCalculadoraTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    public function testSoma()
    {
        $calculadora = new Calculadora();
        $soma= $calculadora->somar(2,2);
        $this->assertEquals(4,$soma,"Teste calculadora soma");
    }

    public function testDividir()
    {
        $calculadora = new Calculadora();

        $dividir= $calculadora->dividir(2,2);

        $this->assertEquals(1,$dividir,"Teste calculadora soma");
    }
    public function testDividirZero()
    {
        $calculadora = new Calculadora();

        $dividir= $calculadora->dividir(2,0);


        $this->assertEquals(1,$dividir,"Teste calculadora soma");
    }
    public function testSubtrair()
    {
        $calculadora = new Calculadora();
        $subtrair= $calculadora->subtrair(2,2);
        $this->assertEquals(0,$subtrair,"Teste calculadora soma");
    }
    public function testMultiplicar()
    {
        $calculadora = new Calculadora();
        $multiplicar= $calculadora->multiplicar(2,2);
        $this->assertEquals(4,$multiplicar,"Teste calculadora soma");
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