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
    }

    // tests
    public function testSomeFeature()
    {

    }
    public function testReceitas(){

        $Receitas = new Receitas();
        $Receitas->Nome_medicamento= "varfine";
        $Receitas->quantidade= "19";
        $Receitas->save();


        $this->tester->seeRecord('common\models\receitas', ['Nome_medicamento' => 'varfine','quantidade' => '19']);

        // $this->tester->dontSeeRecord('common\models\profile', ['First_name' => 'pato','Last_name' => 'ganso' ,'NIF' => '220032320','Address' => 'rua dos patos','Email' => 'pato.ganso@gmail.com','Phone_number' => '923456344','postal_code' => '2440','Birth_date' => '2000-01-04','gender' => 'Male']);

    }
}