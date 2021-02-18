<?php namespace common\tests\models;

use common\models\Contacto;

class contactoTest extends \Codeception\Test\Unit
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
        Contacto::deleteAll();
    }
    public static function adicionarContacto()
    {
        $Contacto = new Contacto();
        $Contacto->id="8";
        $Contacto->nome= "teste do nome";
        $Contacto->assunto= "teste do assunto";
        $Contacto->corpo= "teste do corpo";
        $Contacto->email= "testedo@mail.com";
        $Contacto->id_Categoria= "1";
        $Contacto->id_Utente= "43";
        $Contacto->data_envio= "2021-02-11 00:02:00";
        return $Contacto;
    }
    public function testFields()
    {
        $Contacto = $this->adicionarContacto();
        $this->assertTrue($Contacto->validate());

    }
    public function testAddContacto()
    {
        $Contacto = $this->adicionarContacto();
        $this->assertTrue($Contacto->save());
        $this->tester->seeRecord(Contacto::class, ['id' => '8']);
    }
    public function testAddErroContacto()
    {
        $Contacto = new Contacto();
        $Contacto->id="ola";
        $Contacto->nome= "1";
        $Contacto->assunto= "64";
        $Contacto->corpo= "43";
        $Contacto->email= "43";
        $Contacto->id_Categoria= "ola";
        $Contacto->id_Utente= "43";
        $Contacto->data_envio= "2021-02-11 00:02:00";

        $this->assertFalse($Contacto->save());
        $this->tester->dontSeeRecord(Contacto::class, ['id_Categoria' => 'ola']);

    }
    public function testDeleteContacto()
    {
        $Contacto = $this->adicionarContacto();
        $Contacto->save();
        $this->tester->seeRecord(Contacto::class, ['id' => '8']);
        $Contacto->delete();
        $this->tester->dontSeeRecord(Contacto::class, ['id' => '8']);

    }

    public function testEditContacto()
    {

        $Contacto = $this->adicionarContacto();
        $Contacto->save();
        $Contacto->corpo= "teste para editar";
        $Contacto->save();
        $this->tester->seeRecord(Contacto::class, ['corpo' => 'teste para editar']);

    }
}