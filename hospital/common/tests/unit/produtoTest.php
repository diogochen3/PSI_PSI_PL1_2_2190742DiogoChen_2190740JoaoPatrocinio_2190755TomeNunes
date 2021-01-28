<?php namespace common\tests;

use common\models\Produto;

class produtoTest extends \Codeception\Test\Unit
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
    }

    // tests
    public function testCriaproduto()
    {
        $produto = new Produto();
        $produto->Categoria = "cat";
        $produto->Descricao = "animal";
        $produto->save();
        $this->tester->seeRecord('common\models\Produto',['Categoria' => 'cat',
            'Descricao'=> 'animal']);
    }

    public function testAlterarproduto()
    {
        $produto = new Produto();
        $produto->Categoria = "cat";
        $produto->Descricao = "animal";
        $produto->save();
        $this->tester->seeRecord('common\models\Produto',['Categoria' => 'cat',
            'Descricao'=> 'animal']);
        $produto->Categoria = "cao";
        $produto->save();
        $this->tester->dontSeeRecord('common\models\Produto',['Categoria' => 'cat',
            'Descricao'=> 'animal']);
        $this->tester->seeRecord('common\models\Produto',['Categoria' => 'cao',
            'Descricao'=> 'animal']);
    }

    public function testDeleteproduto()
    {
        $produto = new Produto();
        $produto->Categoria = "cat";
        $produto->Descricao = "animal";
        $produto->save();
        $this->tester->seeRecord('common\models\Produto',['Categoria' => 'cat',
            'Descricao'=> 'animal']);
        $produto->delete();
        $this->tester->dontSeeRecord('common\models\Produto',['Categoria' => 'cat',
            'Descricao'=> 'animal']);
    }

}