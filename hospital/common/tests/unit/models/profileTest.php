<?php namespace common\tests;

use common\models\Profile;

class profileTest extends \Codeception\Test\Unit
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
    public static function adicionarProfile()
    {
        $profile = new Profile();
        $profile->First_name= "pato";
        $profile->Last_name= "ganso";
        $profile->NIF= "220032320";
        $profile->Address= "rua dos patos";
        $profile->Email= "pato.ganso@gmail.com";
        $profile->Phone_number= "923456344";
        $profile->postal_code= "2440";
        $profile->Birth_date= "2000-01-04";
        $profile->gender= "Male";
        $profile->id="74";
        return $profile;
    }
    public function testFields()
    {
        $profile = $this->adicionarProfile();
        $this->assertTrue($profile->validate());

    }
    public function testAddProfile()
    {
        $profile = $this->adicionarProfile();
        $this->assertTrue($profile->save());
        $this->tester->seeRecord(Profile::class, ['id' => '74']);
    }
    public function testAddErroProfile()
    {
        $profile = new Profile();
        $profile->First_name= "pato";
        $profile->Last_name= "ganso";
        $profile->NIF= "testerro";
        $profile->Address= "rua dos patos";
        $profile->Email= "pato.ganso@gmail.com";
        $profile->Phone_number= "923456344";
        $profile->postal_code= "2440";
        $profile->Birth_date= "2000-01-04";
        $profile->gender= "Male";
        $profile->id="74";
        $this->assertFalse($profile->save());
        $this->tester->dontSeeRecord(Profile::class, ['NIF' => 'testerro']);

    }
    public function testDeleteProfile()
    {
        $profile = $this->adicionarProfile();
        $profile->save();
        $this->tester->seeRecord(Profile::class, ['id' => '74']);
        $profile->delete();
        $this->tester->dontSeeRecord(Profile::class, ['id' => '74']);

    }

    public function testEditProfile()
    {

        $profile = $this->adicionarProfile();
        $profile->save();
        $profile->postal_code = "2500";
        $profile->save();
        $this->tester->seeRecord(Profile::class, ['postal_code' => '2500']);

    }
}